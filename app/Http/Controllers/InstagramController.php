<?php

namespace App\Http\Controllers;

use Facebook\HttpClients\FacebookGuzzleHttpClient;
use Guzzle\Http\Client;
use Illuminate\Http\Request;

use App\Http\Requests;


class InstagramController extends Controller
{
    public $instagram;

    public function __construct()
    {
        $this->instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $this->instagram->setUser($username, $password);
            $this->instagram->login();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }

    public function index()
    {


        $i = $this->instagram;

        $datas = $i->getSelfUserFeed();
//        print_r($datas);
//        exit;
        return view('instagram', compact('datas'));
    }


    public function popular()
    {

        $i = $this->instagram;
        $datas = $i->getPopularFeed();

        return view('instagramPopular', compact('datas'));
    }

    public function getFollowers()
    {
        try {
            return $this->instagram->getSelfUsernameInfo()->user->follower_count;
        } catch (\Exception $exception) {
            return "Error";
        }

    }

    public function getFollowing()
    {
        try {
            return $this->instagram->getSelfUsernameInfo()->user->following_count;
        } catch (\Exception $exception) {
            return "Error";
        }

    }

    public function getFollowingUserActivity()
    {
        $datas = $this->instagram->getFollowingRecentActivity();
//        var_dump($datas);
//        exit;
        return view('instagramFollowingActivity', compact('datas'));
    }

    public function home()
    {
        $datas = $this->instagram->timelineFeed();

        return view('instagramTimeline', compact('datas'));
    }


    public function test()
    {
        $i = $this->instagram;

        $datas = $i->timelineFeed();
        print_r($datas);
    }

}
