<?php

namespace App\Http\Controllers;

use App\Allpost;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AllpostController extends Controller
{

    /**
     *  show all posts view
     */
    public function index()
    {
        $posts = \App\Allpost::all();
        return view('allpost', compact('posts'));
    }

    /**
     * @param Request $re
     * delete all post from social media
     */
    public function delFromAll(Request $re)
    {

        $fbDel = FacebookController::fbDel($re->postId);
        $fbgDel = FacebookController::fbgDel($re->postId);
        $twDel = Write::twDel($re->postId);
        $wpDel = WordpressController::wpDel($re->postId);
        $tuDel = Write::tuDel($re->postId);
        Allpost::where('postId', $re->postId)->delete();
//        return "Facebook Page : " .$fbDel . "Facebook Grouup ".$fbgDel." | ".$twDel." | ".$wpDel." | ".$tuDel;
        return "Done";

    }

    /**
     * @return string
     */
    public function delAll()
    {
        try {
            Allpost::truncate();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
