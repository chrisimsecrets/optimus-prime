<?php

namespace App\Http\Controllers;

use App\Allpost;
use App\facebookGroups;
use App\FacebookPages;
use App\FacebookPublicPages;
use App\Fb;
use App\Fbgr;
use App\Setting;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        if(!Data::myPackage('fb')){
            return view('errors.404');
        }
//        check if fbAppSec exists


        if (Data::get('fbAppSec') == "" || Data::get('fbAppId') == "") {
            return redirect('/settings');
        }

        $defPage = Data::get('fbDefPage');
        $fbPages = FacebookPages::where('userId', Auth::user()->id)->get();
        $likes = 0;
        $love = 0;
        $sad = 0;
        $haha = 0;
        $wow = 0;
        $angry = 0;
        $totalReactions = 0;

        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $getPage = FacebookPages::where('pageId', $defPage)->first();
//        $pageToken = $getPage->pageToken;
        try {

            $response = $fb->get('me/?fields=accounts{access_token,id,name,picture,fan_count,feed.limit(10){id,permalink_url,created_time,message,with_tags,from{id,name,picture},link,comments{id,message,comments,from{id,name,picture},created_time},reactions{type}}}', Data::get('fbAppToken'));
            $body = $response->getBody();
            $data = json_decode($body, true);
            $responseForGroup = $fb->get('me/groups?fields=id,name,owner,picture,privacy', Data::get('fbAppToken'));
            $bodyForGroup = $responseForGroup->getBody();
            $fbGroups = json_decode($bodyForGroup, true);

        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return view('Facebook', compact('totalReactions', 'sad', 'likes', 'love', 'haha', 'wow', 'angry', 'data', 'fbPages', 'fbGroups'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function fbGroupIndex()
    {
        if(!Data::myPackage('fb')){
            return view('errors.404');
        }

        $message = "";
        if (facebookGroups::where('userId', Auth::user()->id)->count() <= 0) {
            $message = "nogroup";
            return view('fbgroups', compact('message'));
        }


        if (Setting::where('userId', Auth::user()->id)->value('fbAppSec') == "") {
            return redirect('/settings');
        }

        $likes = 0;
        $love = 0;
        $sad = 0;
        $haha = 0;
        $wow = 0;
        $angry = 0;
        $totalReactions = 0;
        $token = Data::get('fbAppToken');
        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        try {

            $responseForGroup = $fb->get('me/?fields=groups{access_token,id,name,picture,fan_count,feed.limit(10){id,created_time,message,with_tags,from{id,name,picture},link,comments{id,message,comments,from{id,name,picture},created_time},reactions{type}}}', Data::get('fbAppToken'));
            $bodyForGroup = $responseForGroup->getBody();
            $data = json_decode($bodyForGroup, true);


        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return view('fbgroups', compact('message', 'totalReactions', 'sad', 'likes', 'love', 'haha', 'wow', 'angry', 'data', 'token'));
    }

    /**
     * @param Request $re
     * @return string
     * delete post form facebook
     */

    public function fbDelete(Request $re)
    {

        $id = $re->id;
        $token = $re->pageToken;


        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        try {
            $msg = json_decode($fb->delete($id, [], $token)->getBody(), true);
            if ($msg['success'] == 1) {
                Fb::where('postId', $id)->delete();
                return "success";
            }

        } catch (FacebookSDKException $e) {
            return $e->getMessage() . "[ fsdk]";
        } catch (FacebookResponseException $r) {
            return $r->getMessage() . " [ fe ]";
        }

    }

    /**
     * Delete facebook posts
     * @param $id
     * @return string
     */
    public static function fbDel($id)
    {
        if (Fb::where('postId', $id)->where('userId', Auth::user()->id)->exists()) {
            $fbPostId = Fb::where('postId', $id)->value('fbId');
            $pageId = Fb::where('postId', $id)->value('pageId');

            if ($pageId == "") {
                $token = Data::get('fbAppToken');
            } else {
                $token = Data::getToken($pageId);
            }


            $fb = new \Facebook\Facebook([
                'app_id' => Data::get('fbAppId'),
                'app_secret' => Data::get('fbAppSec'),
                'default_graph_version' => 'v2.6',
            ]);
            try {
                $msg = json_decode($fb->delete($fbPostId, [], $token)->getBody(), true);
                if ($msg['success'] == 1) {
                    Fb::where('postId', $id)->delete();
                    return "Deleted form facebook : success";
                }

            } catch (FacebookSDKException $e) {
                return $e->getMessage() . "[ fsdk]";
            } catch (FacebookResponseException $r) {
                return $r->getMessage() . " [ fe ]";
            }
        } else {
//            return "Post couldn't found";
        }


    }

    /**
     * @param $id
     * @return string
     */
    public static function fbgDel($id)
    {
        if (Fbgr::where('postId', $id)->exists()) {
            $fbPostId = Fbgr::where('postId', $id)->value('fbId');
            $token = Data::get('fbAppToken');
            $fb = new \Facebook\Facebook([
                'app_id' => Data::get('fbAppId'),
                'app_secret' => Data::get('fbAppSec'),
                'default_graph_version' => 'v2.6',
            ]);
            try {
                $msg = json_decode($fb->delete($fbPostId, [], $token)->getBody(), true);
                if ($msg['success'] == 1) {
                    Fbgr::where('postId', $id)->delete();
                    return "Deleted form facebook : success";
                }

            } catch (FacebookSDKException $e) {
                return $e->getMessage() . "[ fsdk]";
            } catch (FacebookResponseException $r) {
                return $r->getMessage() . " [ fe ]";
            }
        } else {
//            return "Post couldn't found";
        }


    }

    /**
     * @param Request $re
     * make comment on facebook
     */
    public function fbComment(Request $re)
    {
        if(!Data::myPackage('fb')){
            return view('errors.404');
        }

        $id = $re->id;
        $token = $re->pageToken;
        $message = $re->comment;

        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);

        try {
            $msg = json_decode($fb->post($id . '/comments', ['message' => $message], $token)->getBody(), true);
            if (isset($msg['id'])) {
                echo "Success";
            }
        } catch (FacebookSDKException $fsdk) {
            echo $fsdk->getMessage() . " [fbc fsdk]";
        } catch (FacebookResponseException $fbr) {
            echo $fbr->getMessage() . " [fbc fbr]";
        }

    }

    /**
     * @param Request $re
     * Edit post of facebook
     */
    public function fbEdit(Request $re)
    {
        $id = $re->id;
        $token = $re->pageToken;
        $message = $re->message;

        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);

        try {
            $msg = json_decode($fb->post($id, ['message' => $message], $token), true);
            echo "success";

        } catch (FacebookSDKException $sdke) {
            echo $sdke->getMessage() . " [fbe sdk]";
        } catch (FacebookResponseException $fre) {
            echo $fre->getMessage() . " [fbe fre]";
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function fbReport()
    {
        if(!Data::myPackage('fb')){
            return view('errors.404');
        }

        if (Setting::where('userId', Auth::user()->id)->value('fbAppSec') == "") {
            return redirect('/settings');
        }

//        $countryData = array();
//        $cityData = array();
//
//        $fb = new \Facebook\Facebook([
//            'app_id' => Data::get('fbAppId'),
//            'app_secret' => Data::get('fbAppSec'),
//            'default_graph_version' => 'v2.6',
//        ]);
//
//
//        try {
////            $response = $fb->get("me/accounts?fields=insights,picture,name,fan_count,cover", Data::get('fbAppToken'));
//            $response = $fb->get("273763529635798?fields=insights,picture,name,fan_count,cover", Data::get('fbAppToken'));
//            $body = $response->getBody();
//            $data = json_decode($body, true);
//
//        } catch (FacebookResponseException $e) {
//            echo 'Graph returned an error: ' . $e->getMessage();
//            exit;
//        } catch (FacebookSDKException $e) {
//            echo 'Facebook SDK returned an error: ' . $e->getMessage();
//            exit;
//        }

//        foreach($data['insights']['data'] as $d){
//            echo $d['name'] . "<br>";
//        }

//        print_r($data);
//        exit;

        return view('selectPageForReport');


    }

    public function fbReportSingle($pageId)
    {
        if(!Data::myPackage('fb')){
            return view('errors.404');
        }

        if (Setting::where('userId', Auth::user()->id)->value('fbAppSec') == "") {
            return redirect('/settings');
        }


        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        try {
//            $response = $fb->get("me/accounts?fields=insights,picture,name,fan_count,cover", Data::get('fbAppToken'));
            $data = json_decode($fb->get($pageId . "/insights/page_impressions,page_impressions_unique,page_impressions_paid,page_engaged_users,page_consumptions", Data::get('fbAppToken'))->getBody(), true);


        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
//        foreach ($data['data'] as $d) {
//            echo "===================<br>";
//            echo ($d['name']."<br>");
//            echo $d['title']."<br>";
//            echo $d['description']."<br>";
//            echo $d['period']."<br>";
//            echo "<ul>";
//            foreach ($d['values'] as $values){
//                echo "<li>".$values['value']."</li>";
//            }
//            echo "</ul>";
//            echo "<br>";
//        }
//        print_r($data);

        return view('fbReportViewSingle', compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fbReportView()
    {

        if(!Data::myPackage('fb')){
            return view('errors.404');
        }

        $datas = FacebookPages::where('userId', Auth::user()->id)->get();
        return view('facebookreport', compact('datas'));
    }

    /**
     * @param $pageId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function massSend($pageId)
    {

        if(!Data::myPackage('fb')){
            return view('errors.404');
        }

        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);

        try {
            $response = $fb->get($pageId . '?fields=id,name,picture,category', Data::get('fbAppToken'))->getDecodedBody();
            $name = $response['name'];
            $category = $response['category'];
            $picture = $response['picture']['data']['url'];
        } catch (FacebookResponseException $rs) {
            return $rs->getMessage();
        } catch (FacebookSDKException $sdk) {
            return $sdk->getMessage();
        }
        return view('masssendform', compact('pageId', 'name', 'category', 'picture'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|string
     */
    public function massSendIndex()
    {

        if(!Data::myPackage('fb')){
            return view('errors.404');
        }

        if (Setting::where('userId', Auth::user()->id)->value('fbAppSec') == "") {
            return redirect('/settings');
        }


        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);

        try {
            $data = $fb->get('me/accounts?fields=id,name,picture,fan_count,category,cover', Data::get('fbAppToken'))->getDecodedBody();

        } catch (FacebookResponseException $r) {
            return $r->getMessage();
        } catch (FacebookSDKException $sdk) {
            return $sdk->getMessage();
        }

        return view('masssend', compact('data'));
    }

    /**
     * @param $pageId
     * @return string
     */
    public function massReplay(Request $re)
    {
        $pageId = $re->pageId;
        $message = $re->message;

        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $token = FacebookPages::where('pageId', $pageId)->value('pageToken');


        $conCount = 0;
        $msgCount = 0;

        try {
            $response = $fb->get($pageId . '?fields=conversations.limit(2000)', $token)->getDecodedBody();
            foreach ($response['conversations']['data'] as $conNo => $conversation) {
                $conId = $conversation['id'];
                try {
                    $fb->post($conId . "/messages", ['message' => $message], $token);
                    $msgCount++;
                } catch (\Exception $e) {

                }
                $conCount++;
            }
        } catch (FacebookSDKException $sdk) {
            return $sdk->getMessage();
        } catch (FacebookResponseException $rs) {
            return $rs->getMessage();
        }
        echo "Total conversations = " . $conCount . "<br>";
        echo "Total successful sent message = " . $msgCount;
    }

    /**
     * @param Request $re
     * @return string
     */
    public function scraper(Request $re)
    {
//        here echo used for ajax request

        $query = $re->data;
        $type = $re->type;
        $limit = $re->limit;


        $token = Data::get('fbAppToken');

        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        try {
            if ($type == 'page') {
                $response = $fb->get('search?q=' . $query . '&type=' . $type . '&fields=id,name,picture,link,phone,website,location,fan_count,about,emails' . '&limit=' . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Location</th>
                                <th>Emails</th>
                                <th>Likes</th>
                                <th>About</th>
                            </tr>
                            </thead>
                            <tbody>';
                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $picture = "";
                    $name = "";
                    $phone = "";
                    $website = "";
                    $location = "";
                    $emails = "";
                    $about = "";
                    $likes = "";
                    $lo = "";
                    $em = "";
                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['picture'])) {
                            $picture = $data['picture'];
                        }

                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }

                        if (isset($data['phone'])) {
                            $phone = $data['phone'];
                        }
                        if (isset($data['website'])) {
                            $website = $data['website'];
                        }

                        if (isset($data['location'])) {
                            $location = $data['location'];
                        }

                        if (isset($data['emails'])) {
                            $emails = $data['emails'];
                        }

                        if (isset($data['about'])) {
                            $about = $data['about'];
                        }
                        if (isset($data['fan_count'])) {
                            $likes = $data['fan_count'];
                        }
                        if (isset($data['link'])) {
                            $link = $data['link'];
                        }
                    }
//                  check data if all are vailable

//                    echo '<td>' . $id . '</td>';
                    echo '<td>' . $picture = isset($picture['data']['url']) ? "<img class='img-thumbnail' src='{$picture['data']['url']}'>" : 'Not found' . '</td>';
                    echo '<td><a target="_blank" href="' . $link . '">' . $name . '</a></td>';
                    echo '<td>' . $phone = ($phone == "") ? "<span class='label label-danger'><i class='fa fa-times badge-danger'></i></span>" : $phone . '</td>';
                    echo '<td>' . $website = (isset($website)) ? $website : 'Not found' . '</td>';
                    if (isset($location['country'])) {
                        foreach ($location as $field => $value) {
                            if ($field == 'latitude' || $field == 'longitude') {

                            } else {
                                $lo .= $value . "<br>";
                            }

                        }
                        if (isset($location['latitude'])) {
                            $lo .= '<a class="btn btn-primary btn-xs" target="_blank" href="http://maps.google.com/?q=' . $location['latitude'] . ',' . $location['longitude'] . '">Show Map</a>';
                        }
                        echo '<td>' . $lo . '</td>';
                    } else {
                        echo '<td>' . "<span class='label label-danger'><i class='fa fa-times badge-danger'></i></span>" . '</td>';
                    }
                    if (is_array($emails)) {
                        foreach ($emails as $email) {
                            $em .= $email;
                        }
                        echo '<td>' . $em . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'fa fa-times badge-danger\'></i></span> </td>';
                    }
                    echo '<td>' . $likes . '</td>';
                    echo '<td>' . $about . '</td>';

                    echo '</tr>';
                }
                echo '</tbody><tfoot>
                            <tr> 
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Location</th>
                                <th>Emails</th>
                                <th>Likes</th>
                                <th>About</th>
                            </tr>
                            </tfoot>
                        </table>';
//                print_r($response);
            } elseif ($type == 'user') {
                $response = $fb->get('search?q=' . $query . '&type=' . $type . '&fields=id,name,picture,link,age_range,gender' . '&limit=' . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Age range</th>
                                <th>Gender</th>
                                <th>Profile</th>
                            </tr>
                            </thead>

                            <tbody>';

                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $picture = "";
                    $name = "";
                    $age_range = "";
                    $gender = "";

                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['picture'])) {
                            $picture = $data['picture'];
                        }

                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }
                        if (isset($data['link'])) {
                            $link = $data['link'];
                        }
                        if (isset($data['age_range'])) {
                            $age_range = $data['age_range'];
                        }
                        if (isset($data['gender'])) {
                            $gender = $data['gender'];
                        }
                    }
//                  check data if all are vailable
                    echo '<td>' . $id . '</td>';
                    echo '<td>' . $picture = isset($picture['data']['url']) ? "<img src='{$picture['data']['url']}'>" : 'Not found' . '</td>';
                    echo '<td>' . $name . '</td>';
                    echo '<td>' . $age_range . '</td>';
                    echo '<td>' . $gender . '</td>';
                    echo '<td><a target="_blank" href="' . $link . '">Profile</a></td>';
//                        echo '<td> <span class=\'label label-danger\'><i class=\'fa fa-times badge-danger\'></i></span> </td>';
                    echo '</tr>';
                }
                echo '</tbody>
                            <tfoot>
                            <tr>   
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Age range</th>
                                <th>Gender</th>
                                <th>Profile</th>
                            </tr>
                            </tfoot>
                        </table>';
            } elseif ($type == "event") {
                $response = $fb->get('search?q=' . $query . '&type=' . $type . '&fields=id,picture,name,place,attending_count,interested_count,noreply_count,declined_count,start_time,end_time,description,link,owner{name,link,picture}' . '&limit=' . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                
                                <th>Name</th>
                                <th>Place</th>
                                <th>End time</th>
                                <th>Description</th>
                                <th>Owner</th>
                                <th>More info</th>
                                
                            </tr>
                            </thead>

                            <tbody>';

                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $name = "";
                    $location = "";
                    $end_time = "";
                    $description = "";
                    $lo = "";

                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }

                        if (isset($data['place'])) {
                            $location = $data['place'];
                        }
                        if (isset($data['end_time'])) {
                            $end_time = $data['end_time'];
                        }

                        if (isset($data['description'])) {
                            $description = $data['description'];
                        }
                        if (isset($data['id'])) {
                            $link = $data['id'];
                        }


                    }
//                  check data if all are vailable

                    echo '<td><img class="img-thumbnail" src="' . $data['picture']['data']['url'] . '"><br><a target="_blank" href="https://facebook.com/' . $link . '">' . $name . '</a></td>';
                    if (isset($location['location']['country'])) {
                        foreach ($location['location'] as $field => $value) {
                            if ($field == 'latitude' || $field == 'longitude') {

                            } else {
                                $lo .= $value . "<br>";
                            }

                        }
                        if (isset($location['location']['latitude'])) {
                            $lo .= '<a class="btn btn-primary btn-xs" target="_blank" href="http://maps.google.com/?q=' . $location['location']['latitude'] . ',' . $location['location']['longitude'] . '">Show Map</a>';
                        }
                        echo '<td>' . $lo . '</td>';
                    } else {
                        echo '<td>' . "<span class='label label-danger'><i class='fa fa-times badge-danger'></i></span>" . '</td>';
                    }
                    echo '<td>' . Prappo::date($end_time) . '</td>';
                    echo '<td>' . $description . '</td>';
                    echo '<td><img class="img-circle" src="' . $data['owner']['picture']['data']['url'] . '"><br><a target="_blank" href="' . $data['owner']['link'] . '">' . $data['owner']['name'] . '</a></td>';
                    echo '<td>' .
                        '<span class="text-green">Attending ' . $data['attending_count'] . '</span><br>' .
                        '<span class="text-blue">Interested ' . $data['interested_count'] . '</span><br>' .
                        '<span class="text-yellow">Noreply ' . $data['noreply_count'] . '</span><br>' .
                        '<span class="text-red">Declined ' . $data['declined_count'] . '</span><br>' .
                        '</td>';
//                        echo '<td> <span class=\'label label-danger\'><i class=\'fa fa-times badge-danger\'></i></span> </td>';
                    echo '</tr>';
                }
                echo '</tbody>
                            <tfoot>
                            <tr>   
                                
                                <th>Name</th>
                                <th>Place</th>
                                <th>End time</th>
                                <th>Description</th>
                                <th>Owner</th>
                                <th>More info</th>
                            </tr>
                            </tfoot>
                        </table>';
            } elseif ($type == 'group') {
                $response = $fb->get('search?q=' . $query . '&type=' . $type . '&fields=id,name,privacy,link,picture,description,owner{id,name,picture,link}' . '&limit=' . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Privacy</th>
                                <th>Description</th>
                                <th>Owner</th>
                                <th>Link</th>
                            </tr>
                            </thead>

                            <tbody>';

                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $name = "";
                    $privacy = "";

                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }

                        if (isset($data['id'])) {
                            $link = $data['id'];
                        }
                        if (isset($data['privacy'])) {
                            $privacy = $data['privacy'];
                        }
                        if (isset($data['owner'])) {
                            $owner_id = $data['owner']['id'];
                            $owner_name = $data['owner']['name'];
                            $owner_picture = $data['owner']['picture']['data']['url'];
                        }


                    }
//                  check data if all are vailable
                    echo '<td>' . $id . '</td>';
                    echo '<td><img class="img-thumbnail" src="' . $data['picture']['data']['url'] . '"><br><a target="_blank" href="https://facebook.com/' . $link . '">' . $name . '</a></td>';
                    echo '<td>' . $privacy . '</td>';
                    if (isset($data['description'])) {
                        echo '<td>' . $data['description'] . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'fa fa-times badge-danger\'></i></span> </td>';
                    }
                    if (isset($data['owner'])) {
                        echo '<td><img src="' . $data['owner']['picture']['data']['url'] . '"><br>' . '<a target="_blank" href="' . $data['owner']['link'] . '">' . $data['owner']['name'] . '</a></td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'fa fa-times badge-danger\'></i></span> </td>';
                    }
                    echo '<td><a target="_blank" href="https://facebook.com/' . $data['id'] . '">Link</a>';

                    echo '</tr>';
                }
                echo '</tbody>
                            <tfoot>
                            <tr>   
                                <th>ID</th>
                                <th>Name</th>
                                <th>Privacy</th>
                                <th>Description</th>
                                <th>Owner</th>
                                <th>Link</th>
                            </tr>
                            </tfoot>
                        </table>';
            } elseif ($type == 'place') {

                $response = $fb->get("search?q=" . $query . "&type=" . $type . "&fields=id,name,category,picture,location,link,website,phone,description,about" . "&limit=" . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>Name</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>About</th>
                            </tr>
                            </thead>
                            <tbody>';
                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $picture = "";
                    $name = "";
                    $phone = "";
                    $website = "";
                    $location = "";
                    $about = "";
                    $lo = "";
                    $em = "";
                    $description = "";
                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['picture'])) {
                            $picture = $data['picture']['data']['url'];
                        }

                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }

                        if (isset($data['phone'])) {
                            $phone = $data['phone'];
                        }
                        if (isset($data['website'])) {
                            $website = $data['website'];
                        }

                        if (isset($data['location'])) {
                            $location = $data['location'];
                        }
                        if (isset($data['link'])) {
                            $link = $data['link'];
                        }

                    }
//                  check data if all are vailable

                    echo '<td><img class="img-thumbnail" src="' . $picture . '"><br>' . '<a target="_blank" href="' . $link . '">' . $name . '</a></td>';
                    echo '<td>' . $data['category'] . '</td>';
                    if ($phone != "") {
                        echo '<td>' . $phone . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'fa fa-times badge-danger\'></i></span> </td>';
                    }
                    echo '<td>' . $website . '</td>';
                    if (isset($location['country'])) {
                        foreach ($location as $field => $value) {
                            if ($field == 'latitude' || $field == 'longitude') {

                            } else {
                                $lo .= $value . "<br>";
                            }

                        }
                        if (isset($location['latitude'])) {
                            $lo .= '<a class="btn btn-primary btn-xs" target="_blank" href="http://maps.google.com/?q=' . $location['latitude'] . ',' . $location['longitude'] . '">Show Map</a>';
                        }
                        echo '<td>' . $lo . '</td>';
                    } else {
                        echo '<td>' . "<span class='label label-danger'><i class='fa fa-times badge-danger'></i></span>" . '</td>';
                    }
                    if (isset($data['description'])) {
                        echo '<td>' . $data['description'] . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'fa fa-times badge-danger\'></i></span> </td>';
                    }

                    if (isset($data['about'])) {
                        echo '<td>' . $data['about'] . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'fa fa-times badge-danger\'></i></span> </td>';
                    }


//
                    echo '</tr>';
                }
                echo '</tbody><tfoot>
                            <tr> 
                                <th>Name</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>About</th>
                            </tr>
                            </tfoot>
                        </table>';
            }


        } catch (FacebookSDKException $sdk) {
            return $sdk->getMessage();

        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function massComment()
    {
        if(!Data::myPackage('fb')){
            return view('errors.404');
        }

        $pages = FacebookPublicPages::where('userId', Auth::user()->id)->get();
        return view('fbmasspage', compact('pages'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function publicPageAdd(Request $request)
    {

        $url = $request->url;
        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $token = Data::get('fbAppToken');
        $data = $fb->get($url, $token)->getDecodedBody();
        if (isset($data['name'])) {
            $name = $data['name'];
            $id = $data['id'];
            if (!FacebookPublicPages::where('pageId', $id)->where('email', Auth::user()->email)->exists()) {
                $fbPublicPage = new FacebookPublicPages();
                $fbPublicPage->pageName = $name;
                $fbPublicPage->pageId = $id;
                $fbPublicPage->userId = Auth::user()->id;
                $fbPublicPage->save();
                return "success";
            } else {
                return "This Page already saved";
            }
        } else {
            return "Page not found";
        }

    }

    /**
     * @param Request $request
     */
    public function massCommentAction(Request $request)
    {
        $com = $request->text;
        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $token = Data::get('fbAppToken');
        $pageCount = 0;
        $commentCount = 0;
        $publicPages = FacebookPublicPages::where('userId', Auth::user()->id)->get();
        foreach ($publicPages as $page) {
            $pageCount++;
            $data = $fb->get($page->pageId . '/feed?limit=1', $token)->getDecodedBody();
            foreach ($data['data'] as $d) {
                self::comment($d['id'], $com);
                $commentCount++;
            }
        }

        echo "Total Page : " . $pageCount . " and total comments : " . $commentCount;
    }

    /**
     * @param Request $request
     */
    public function massCommentPageAction(Request $request)
    {
        $com = $request->text;
        $pageId = $request->id;
        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $token = Data::get('fbAppToken');
        $commentCount = 0;
        $data = $fb->get($pageId . '/feed?limit=10', $token)->getDecodedBody();
        foreach ($data['data'] as $d) {
            self::comment($d['id'], $com);
            $commentCount++;
        }

        echo "Total comments : " . $commentCount;
    }

    /**
     * @param $id
     * @param $text
     * @return string
     */
    public static function comment($id, $text)
    {

        if(!Data::myPackage('fb')){
            return view('errors.404');
        }


        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $token = Data::get('fbAppToken');
        try {
            $fb->post($id . '/comments', array('message' => $text), $token);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param Request $request
     * @return string
     */
    public function deletePage(Request $request)
    {
        $id = $request->id;
        try {
            FacebookPublicPages::where('id', $id)->where('email', Auth::user()->email)->delete();
            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
