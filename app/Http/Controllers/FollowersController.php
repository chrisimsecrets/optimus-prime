<?php

namespace App\Http\Controllers;

use App\Setting;
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
        if (Setting::where('field', 'twTokenSec')->exists()) {
            foreach (Setting::where('field', 'twAppToken')->get() as $d) {
                if ($d->value == "") {
                    return redirect('/settings');
                }
            }
        } else {
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
        $consumerKey = self::get_value('twConKey');
        $consumerSecret = self::get_value('twConSec');
        $accessToken = self::get_value('twToken');
        $tokenSecret = self::get_value('twTokenSec');

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
        $blogName = self::get_value('tuDefBlog');


        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');

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
        return DB::table('settings')->where('field', $field)->value('value');
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
