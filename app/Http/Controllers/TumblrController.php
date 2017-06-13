<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tumblr\API\Client;

class TumblrController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        if(!Data::myPackage('tu')){
            return view('errors.404');
        }

        if(Data::get('tuTokenSec') == "" || Data::get('tuConSec')==""){
            return redirect('/settings');
        }

        $blogName = Data::get('tuDefBlog');
        $consumerKey = Data::get('tuConKey');
        $consumerSecret = Data::get('tuConSec');
        $token = Data::get('tuToken');
        $tokenSecret = Data::get('tuTokenSec');

        $client = new Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {

            $post = $client->getBlogPosts($blogName);

            $avatar = $client->getBlogAvatar($blogName);
            $blog = $post->blog->title;
            $description = $post->blog->description;
            $followers = $post->blog->followers;
            $totalPosts = $post->blog->posts;
            $subscribed = $post->blog->subscribed;
            $admin = $post->blog->admin;
            $type = $post->blog->type;
            $message = $post->blog->messages;
            $ask = $post->blog->ask;
            $dashboard = $client->getDashboardPosts();

        } catch (\Exception $e) {
            echo "error";
        }

        return view('Tumblr',compact('avatar','post','blog','followers','description','totalPosts','subscribed','admin','type','message','ask','dashboard'));
    }

    /**
     * @param $field
     * @return mixed
     */

}
