<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Support\Facades\Auth;
use Tumblr\API;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FollowersController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        set_time_limit(120);


        if(Data::get('twTokenSec')==""){
            return redirect('/settings');
        }
        $data = new HomeController();
        $fbLikes = $data->fbLikes();
        $twFollowers = $data->twFollowers();
        $tuFollowers = $data->tuFollowers();

        return view('followers', compact('fbLikes', 'twFollowers', 'tuFollowers'));

    }

    /**
     * Get twitter followers count
     * @return string
     */
    public static function twFollowers()
    {
        $consumerKey =Data::get('twConKey');
        $consumerSecret = Data::get('twConSec');
        $accessToken = Data::get('twToken');
        $tokenSecret = Data::get('twTokenSec');

        try {


            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
            $followerCount = $twitter->load(\Twitter::ME);
            $fc = $followerCount[0]->user->followers_count;
            return $fc; // count twitter followers
        } catch (\TwitterException $e) {
//            die("something went wrong . We couldn't fetch data form twitter . May be maximum api request done");
            return "error";
        }
    }

    /**
     * @return string
     */
    public static function tuFollowers()
    {
        $blogName = Data::get('tuDefBlog');


        $consumerKey = Data::get('tuConKey');
        $consumerSecret = Data::get('tuConSec');
        $token = Data::get('tuToken');
        $tokenSecret = Data::get('tuTokenSec');

        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);

        try {

            return $client->getBlogFollowers($blogName, null)->total_users;
        } catch (\Exception $e) {
//            return $e->getMessage();
            return "error";
        }
    }


    /**
     * @param $field
     * @return mixed
     */
    public static function get_value($field)
    {
        return DB::table('settings')->where('userId',Auth::user()->id)->value($field);
    }

    /**
     * show few twitter followers
     */
    public function showTwFollowers()
    {

        set_time_limit(120);
        $count = 0;
        $consumerKey = self::get_value('twConKey');
        $consumerSecret = self::get_value('twConSec');
        $accessToken = self::get_value('twToken');
        $tokenSecret = self::get_value('twTokenSec');
        try {
            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
            $followers = $twitter->loadUserFollowers(self::get_value('twUser'));
            foreach ($followers->ids as $id) {
                echo "<li>
                          <img src='" . $twitter->loadUserInfoById($id)->profile_image_url . "' alt='User Image'>
                          <a class='users-list-name' target='_blank' href='https://twitter.com/" . $twitter->loadUserInfoById($id)->screen_name . "'>" . $twitter->loadUserInfoById($id)->name . "</a>
                            <span class='users-list-date'>Twitter</span>
                        </li>";
                $count += 1;
                if ($count == 16) {
                    break;
                }
            }
        } catch (\TwitterException $e) {
            echo "error";
        }


    }

    /**
     * show all twitter followers
     */
    public function showAllTwFollowers()
    {

        set_time_limit(120);

        $consumerKey = self::get_value('twConKey');
        $consumerSecret = self::get_value('twConSec');
        $accessToken = self::get_value('twToken');
        $tokenSecret = self::get_value('twTokenSec');
        try {
            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
            $followers = $twitter->loadUserFollowers(self::get_value('twUser'));
            foreach ($followers->ids as $id) {
                echo "<li>
                          <img src='" . $twitter->loadUserInfoById($id)->profile_image_url . "' alt='User Image'>
                          <a class='users-list-name' target='_blank' href='https://twitter.com/" . $twitter->loadUserInfoById($id)->screen_name . "'>" . $twitter->loadUserInfoById($id)->name . "</a>
                            <span class='users-list-date'>Twitter</span>
                        </li>";

            }
        } catch (\TwitterException $e) {
            echo "error";
        }
    }

    public function liCompanyFollowers()
    {

    }

}
