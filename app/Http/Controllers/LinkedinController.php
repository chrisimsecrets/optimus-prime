<?php

namespace App\Http\Controllers;

use App\Setting;
use Happyr\LinkedIn\LinkedIn;
use Illuminate\Http\Request;

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
     * Show linkedin mass comment page.
     */
    public function massComment()
    {
        $companies = self::companies()['values'];

        return view('limasscomment', compact('companies'));
    }

    /**
     * Mass comment in action.
     *
     * @param Request $request
     * @return mixed
     */
    public function doMassComment(Request $request)
    {
        $linkedIn = app('linkedin');

        if ($request->to[0] === 'all') {
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
        } catch (\Exception $e) {
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
     * @param $linkedIn
     * @return mixed
     * @throws \Exception
     */
    protected function sendCommentToCompanies(Request $request, $companies, $linkedIn)
    {
        dd($request->all());
        $body = [
            'json' => [
                'comment' => $request->comment
            ]
        ];

        foreach ($companies['values'] as $company) {
            $allUpdates = $linkedIn->get("/v1/companies/{$company['id']}/updates?format=json");

            if ($request->has('in_all')) {
                $updates = $allUpdates['values'];
            } elseif (is_numeric($request->in_last)) {
                $updates = array_slice($allUpdates['values'], 0, $request->in_last, true);
            }

            if (empty($updates)) {
                throw new \Exception('Check in all updates or enter in last update(s) field');
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
}
