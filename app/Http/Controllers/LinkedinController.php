<?php

namespace App\Http\Controllers;

use Exception;
use App\Setting;
use Illuminate\Http\Request;
use Happyr\LinkedIn\LinkedIn;

class LinkedinController extends Controller
{
    public function callback(Request $request)
    {
        $linkedIn = new LinkedIn(Data::get('liClientId'), Data::get('liClientSecret'));

        Setting::where('field', 'liAccessToken')->update(['value' => $linkedIn->getAccessToken()]);

        return redirect('/settings');
    }

    /**
     * Get all companies.
     *
     * @param $linkedIn
     * @return mixed
     */
    public static function companies($linkedIn = '')
    {
        if ($linkedIn === '') {
            $linkedIn = app('linkedin');
        }

        return $linkedIn->get('v1/companies?format=json&is-company-admin=true');
    }

    /**
     * Get companies list with it's followers.
     *
     * @return array
     */
    public static function companiesWithDetails()
    {
        /** @var LinkedIn $linkedIn */
        $linkedIn = app('linkedin');

        $companies = self::companies($linkedIn)['values'];

        // Getting followers for the companies and merging tho the companies list array.
        return array_reduce($companies, function ($carry, $company) use ($linkedIn) {
            $carry[] = $linkedIn->get("/v1/companies/{$company['id']}:(id,name,logo-url,num-followers)?format=json");

            return $carry;
        });
    }

    /**
     * Show linkedin mass comment page.
     */
    public function massComment()
    {
        if (!Data::get('liAccessToken')) {
            return redirect('/settings');
        }

        $companies = self::companies()['values'];

        return view('limasscomment', compact('companies'));
    }

    /**
     * Mass comment in action.
     *
     * @param Request $request
     * @return mixed
     */
    public function fireMassComment(Request $request)
    {
        $linkedIn = app('linkedin');

        if ($request->has('to') && $request->to[0] === 'all') {
            $companies = self::companies($linkedIn);
        } elseif($request->has('to') && is_array($request->to)) {
            $companies = array_reduce($request->to, function ($carry, $to) {
                $carry['values'][]['id'] = $to;

                return $carry;
            });
        }

        if (!isset($companies)) {
            return [
                'status' => 'error',
                'error' => 'No company selected'
            ];
        }
        try {
            $this->sendCommentToCompanies($request, $companies, $linkedIn);

            return [
                'status' => 'success',
                'msg' => 'Mass comment successful'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Send comment to companies in linkedin API.
     *
     * @param Request $request
     * @param $companies
     * @param LinkedIn $linkedIn
     * @return mixed
     * @throws Exception
     */
    protected function sendCommentToCompanies(Request $request, $companies, $linkedIn)
    {
        $body = [
            'json' => [
                'comment' => $request->comment
            ]
        ];

        foreach ($companies['values'] as $company) {
            $allUpdates = $linkedIn->get("/v1/companies/{$company['id']}/updates?format=json");

            if ($allUpdates['_total'] === 0) {
                throw new Exception('No update to add comment');
            }

            if ($request->has('in_all')) {
                $updates = $allUpdates['values'];
            } elseif (is_numeric($request->in_last)) {
                $updates = array_slice($allUpdates['values'], 0, $request->in_last, true);
            }

            if (empty($updates)) {
                throw new Exception('Check in all updates or enter in last update(s) field');
            }

            foreach ($updates as $update) {
                if (!$update['isCommentable']) {
                    continue;
                }

                $linkedIn->post(
                    "/v1/companies/{$company['id']}/updates/key={$update['updateKey']}/update-comments-as-company/",
                    $body
                );
            }
        }
    }

    /**
     * Show company updates.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updates()
    {
        if (!Data::get('liAccessToken')) {
            return redirect('/settings');
        }

        $companies = self::companiesWithDetails();

        return view('liupdates', compact('companies'));
    }
}
