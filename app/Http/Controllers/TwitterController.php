<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TwitterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (Setting::where('field', 'twTokenSec')->exists()) {
            foreach (Setting::where('field', 'twTokenSec')->get() as $d) {
                if ($d->value == "") {
                    return redirect('/settings');
                }
            }
        } else {
            return redirect('/settings');
        }

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

        $me = $twitter->load(\Twitter::ME);
        $twRep = $twitter->load(\Twitter::REPLIES);
        $tw = $twitter->load(\Twitter::ME_AND_FRIENDS);
        return view('Twitter', compact('tw', 'twRep', 'me'));
    }

    public function getInboxIndex()
    {

    }

    /**
     * @param Request $re
     * @return string
     */
    public function retweet(Request $re)
    {

        $id = $re->id;

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/retweet', 'POST', array('id' => $id));
            return "success";
//            print_r($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return string
     */
    public static function retweetnow($id)
    {

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/retweet', 'POST', array('id' => $id));
            return "success";

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Request $re
     * @return string
     */
    public function twSendMsg(Request $re)
    {
        $username = $re->username;
        $text = $re->text;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('direct_messages/new', 'POST', array('screen_name' => $username, 'text' => $text));
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $user
     * @param $message
     * @return string
     */
    public static function SendMsg($user, $message)
    {
        $username = $user;
        $text = $message;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('direct_messages/new', 'POST', array('screen_name' => $username, 'text' => $text));
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function twReply(Request $request)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $text = $request->text;
        $statusId = $request->id;
        $username = $request->username;
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/update', 'POST', array('status' => "@" . $username . " " . $text, 'in_reply_to_status_id' => $statusId), NULL);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param $id
     * @param $user
     * @param $text
     * @return string
     */
    public static function twReplyNow($id, $user, $text)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $statusId = $id;
        $username = $user;
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/update', 'POST', array('status' => "@" . $username . " " . $text, 'in_reply_to_status_id' => $statusId), NULL);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function massSend()
    {
        return view('twmasssend');
    }

    /**
     * @param Request $re
     * @return string
     */
    public function massMessageSend(Request $re)
    {
        $message = $re->text;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        try {
            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
            $followers = $twitter->request('followers/list', 'GET', []);
            $count = 0;
            echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>';
            foreach ($followers->users as $users) {
                $msg = TwitterController::SendMsg($users->screen_name, $message);
                echo '<tr>';
                echo '<td>' . $users->screen_name . '</td>';
                echo '<td>' . $msg . '</td>';
                echo '</tr>';
                if ($msg == 'success') {
                    $count++;
                }

            }
            echo '</tbody><tfoot>
                            <tr> 
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                        </table>';
            echo '<div class="alert alert-success" role="alert">Successfully sent to ' . $count . ' users </div>';

        } catch (\TwitterException $e) {
//            die("something went wrong . We couldn't fetch data form twitter . May be maximum api request done");
            return "error";
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendMessage()
    {
        return view('twsendmessage');
    }

    /**
     * @return string
     */
    public function autoRetweet()
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        try {
            $mentions = $twitter->request('statuses/mentions_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";

                $msg = self::retweetnow($m->id);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' retweeted</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoRetweetIndex()
    {
        return view('retweet');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function autoReply(Request $request)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        $text = $request->text;
        try {
            $mentions = $twitter->request('statuses/mentions_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";


                $msg = self::twReplyNow($m->id, $m->user->screen_name, $text);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' replied</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param Request $request
     * @return string
     */
    public static function autoReplyAll(Request $request)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        $text = $request->text;
        try {
            $mentions = $twitter->request('statuses/home_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";


                $msg = self::twReplyNow($m->id, $m->user->screen_name, $text);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' replied</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoReplyIndex()
    {
        return view('reply');
    }


}
