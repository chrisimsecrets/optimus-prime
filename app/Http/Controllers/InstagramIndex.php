<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InstagramIndex extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }
    /**
     * Auto follow page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoFollowIndex()
    {
        return view('instagramAutoFollow');
    }

    public function autoUnfollowIndex()
    {
        return view('instagramAutoUnfollow');
    }

    public function autoCommentsIndex()
    {
        return view('instagramAutoComments');
    }

    public function autoLikes()
    {
        return view('instagramAutoLikes');
    }

    public function autoMessageIndex()
    {
        return view('instagramAutoMessage');
    }

    public function scraper(){
        return view('instagramScraper');
    }
}
