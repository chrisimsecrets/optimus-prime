<?php

namespace App\Http\Controllers;

use App\Allpost;
use App\Dashboard;
use App\facebookGroups;
use App\FacebookPages;
use App\Fb;
use App\Http\Requests;
use App\OptLog;
use App\OptSchedul;
use App\Tu;
use App\TuBlogs;
use App\Tw;
use App\User;
use App\Wp;
use Facebook\FacebookRequest;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        if (Data::get('fbAppSec') != "" || Data::get('wpPassword') != "" || Data::get('tuTokenSec') != "" || Data::get('twTokenSec') != "") {

        } else {
            return redirect('/settings');
        }

        $fbPostCount = Fb::all()->count();
        $twPostCount = Tw::all()->count();
        $tuPostCount = Tu::all()->count();
        $wpPostCount = Wp::all()->count();
        $fbgCount = facebookGroups::all()->count();
        $fbPageCount = FacebookPages::all()->count();
        $allPost = Allpost::all()->count();

        $fbPages = FacebookPages::all()->count();
        $fbGroups = facebookGroups::all()->count();
        $tuBlogs = TuBlogs::all()->count();
        $schedules = OptSchedul::all()->count();
        $logs = OptLog::all()->count();
        $user = User::all()->count();

        return view('home', compact(
            'fbPostCount',
            'twPostCount',
            'tuPostCount',
            'wpPostCount',
            'fbgCount',
            'fbPageCount',
            'allPost',
            'fbPages',
            'fbGroups',
            'tuBlogs',
            'schedules',
            'logs',
            'user'
        ));
    }

    /**
     * @return string
     * get facebook likes
     */
    public function fbLikes()
    {
        try {
            $likes = new Settings();
            $total_likes = $likes->total_likes();
            return $total_likes;
        } catch (\Exception $e) {
            return 'error';
        }

    }


    /**
     * @return string
     * get total twitter followers
     */
    public function twFollowers()
    {
        try {
            $twFollowers = FollowersController::twFollowers();
            return $twFollowers;
        } catch (\Exception $e) {
            return 'error';
        }
    }

    /**
     * @return string
     * get total tumblr followers
     */
    public function tuFollowers()
    {
        try {
            $tuFollowers = FollowersController::tuFollowers();
            return $tuFollowers;
        } catch (\Exception $e) {
            return 'error';
        }
    }

    /**
     * Get Total linkedin companies.
     *
     * @return string
     */
    public function liTotalCompanies()
    {
        try {
            return LinkedinController::companies()['_total'];
        } catch (\Exception $e) {
            return 'error';
        }
    }

    /**
     * Get all companies followers.
     *
     * @return int
     */
    public function companyFollowers()
    {
        try {
            $linkedIn = app('linkedin');

            $companies = LinkedinController::companies($linkedIn);

            $followers = 0;

            foreach ($companies['values'] as $company) {
                $followers += $linkedIn->get("/v1/companies/{$company['id']}/num-followers?format=json");
            }

            return $followers;
        } catch (\Exception $e) {
            return 'error';
        }
    }

    /**
     * Get total company updates.
     */
    public function liCompanyUpdates()
    {
        try {
            $linkedIn = app('linkedin');

            $companies = LinkedinController::companies($linkedIn);

            $total = 0;

            foreach ($companies['values'] as $company) {
                $total += $linkedIn->get("/v1/companies/{$company['id']}/updates?format=json")['_total'];
            }

            return $total;
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function liPostedJobs()
    {
        try {
            $linkedIn = app('linkedin');

            $companies = LinkedinController::companies($linkedIn);

            $total = 0;

            foreach ($companies['values'] as $company) {
                $total += $linkedIn->get(
                    "/v1/companies/{$company['id']}/updates?event-type=job-posting&format=json&format=json-get"
                )['_total'];
            }

            return $total;
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
