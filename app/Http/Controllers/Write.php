<?php

namespace App\Http\Controllers;

use App\Allpost;
use App\facebookGroups;
use App\FacebookPages;
use App\Fb;
use App\Fbgr;
use App\OptLog;
use App\OptSchedul;
use App\Setting;
use App\Tu;
use App\Tw;
use App\Wp;
use DB;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;
use Happyr\LinkedIn\LinkedIn;
use Illuminate\Http\Request;
use Tumblr\API;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Write extends Controller
{

    public static function get_value($field)
    {
        return DB::table('settings')->where('field', $field)->value('value');
    }

    public function index()
    {
        Prappo::writeCheck();
        if (Data::get('fbAppSec') != "" || Data::get('wpPassword') != "" || Data::get('tuTokenSec') != "" || Data::get('twTokenSec') != "" || Data::get('skypePass')) {

        } else {
            return redirect('/settings');
        }

        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');

        $tuClient = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {
            $tuBlogName = $tuClient->getUserInfo()->user->blogs;
            $tuMsg = "success";
        } catch (\Exception $e) {
            $tuMsg = "error";
        }

        $getLang = Setting::where('field', 'lang')->get();
        foreach ($getLang as $lang) {
            $l = $lang->value;
        }

        $fbPages = FacebookPages::all();
        $fbGroups = facebookGroups::all();
        return view('write', compact('l', 'tuBlogName', 'fbPages', 'fbGroups', 'tuMsg'));
    }

    public function postWrite(Request $re)
    {

        $title = $re->title;
        $content = $re->data;
        $postId = $re->postId;

        $write = new Allpost();
        $write->title = $title;
        $write->content = $content;
        $write->postId = $postId;
        $write->save();
        echo "success";


    }

    public function delPost(Request $re)
    {
        $id = $re->id;
        try {
            Allpost::where('id', $id)->delete();
            echo "success";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function wpWrite(Request $re)
    {
        $content = $re->data;
        if($re->imagepost=='yes'){
            $content = $re->data . "<br>"."<img src='".url('/')."/uploads/".$re->image."'>";
        }

        $title = $re->title;
        $pId = $re->postId;
        $url = self::get_value('wpUrl');
        $userName = self::get_value('wpUser');
        $password = self::get_value('wpPassword');

        $query = 'insert into wordpress.post (title, description, blogurl, username, password) values ("' . $title . '", "' . $content . '", "' . $url . '", "' . $userName . '", "' . $password . '")';
        $url = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($query) . '&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);

        $rawdata = curl_exec($c);


        $json = json_decode($rawdata, true);
        curl_close($c);
        $postId = $json['query']['results']['postid'];
        if ($postId == "") {
            echo "error";
        } else {
            $wp = new Wp();
            $wp->postId = $pId;
            $wp->wpId = $postId;
            $wp->title = $title;
            $wp->content = $content;
            $wp->save();
            echo "success";
        }


    }


    public static function wpWriteS($spostId, $stitle, $scontent, $type)
    {
        $log = new OptLog();
        $content = $scontent;
        $title = $stitle;
        $pId = $spostId;
        $url = self::get_value('wpUrl');
        $userName = self::get_value('wpUser');
        $password = self::get_value('wpPassword');

        $query = 'insert into wordpress.post (title, description, blogurl, username, password) values ("' . $title . '", "' . $content . '", "' . $url . '", "' . $userName . '", "' . $password . '")';
        $url = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($query) . '&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);

        $rawdata = curl_exec($c);


        $json = json_decode($rawdata, true);
        curl_close($c);
        $postId = $json['query']['results']['postid'];
        if ($postId == "") {

            $log->postId = $postId;
            $log->status = "error";
            $log->from = "Wordpress";
            $log->type = $type;
        } else {
            echo $postId;
            $wp = new Wp();
            $wp->postId = $pId;
            $wp->wpId = $postId;
            $wp->save();
            $log->postId = $postId;
            $log->from = "Wordpress";
            $log->status = "success";
            $log->type = $type;
        }
    }


    public function twWrite(Request $re)
    {
        $content = $re->data;
        $postId = $re->postId;
        $image = public_path() . '/uploads/' . $re->image;

        $consumerKey = self::get_value('twConKey');
        $consumerSecret = self::get_value('twConSec');
        $accessToken = self::get_value('twToken');
        $tokenSecret = self::get_value('twTokenSec');

        if ($re->imagepost == 'yes') {
            try {

                $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

                $data = $twitter->request($image ? 'statuses/update_with_media' : 'statuses/update', 'POST', array('status' => $content), $image ? array('media[]' => $image) : NULL);

                echo "success";
                if (isset($postId)) {
                    $tw = new Tw();
                    $tw->postId = $postId;
                    $tw->twId = $data->id;
                    $tw->save();
                }


            } catch (\TwitterException $e) {

                echo $e->getMessage();
            }
        } else {
            try {

                $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

                $data = $twitter->send($content);

                echo "success";
                if (isset($postId)) {
                    $tw = new Tw();
                    $tw->postId = $postId;
                    $tw->twId = $data->id;
                    $tw->save();
                }


            } catch (\TwitterException $e) {

                echo $e->getMessage();
            }
        }
    }


    /**
     * @param $spostId
     * @param $simage
     * @param $scontent
     */
    public static function twWriteS($spostId, $simage, $scontent, $type)
    {
        $content = $scontent;
        $postId = $spostId;
        $image = public_path() . '/uploads/' . $simage;

        $consumerKey = self::get_value('twConKey');
        $consumerSecret = self::get_value('twConSec');
        $accessToken = self::get_value('twToken');
        $tokenSecret = self::get_value('twTokenSec');
        $log = new OptLog();
        try {

            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

            $data = $twitter->request($image ? 'statuses/update_with_media' : 'statuses/update', 'POST', array('status' => $content), $image ? array('media[]' => $image) : NULL);

            echo "success";
            if (isset($postId)) {
                $tw = new Tw();
                $tw->postId = $postId;
                $tw->twId = $data->id;
                $tw->save();
                $log->postId = $postId;
                $log->status = "success";
                $log->from = "Twitter";
                $log->type = $type;
            }


        } catch (\TwitterException $e) {
            $log->postId = $postId;
            $log->status = "error";
            $log->from = "Twitter";
            $log->type = $type;
            echo $e->getMessage();
        }

        $log->save();
    }

    public function tuWrite(Request $re)
    {
        $blogName = $re->blogName;
        $title = $re->title;
        $content = $re->data;
        $pId = $re->postId;
        $image = url('') . '/uploads/' . $re->image;
        $imagepost = $re->imagepost;
        $caption = $re->caption;
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        if ($imagepost == 'yes') {
            $data = array(
                "type" => "photo",
                "title" => $title,
                "caption" => $content,
                "source" => $image
            );
        } else {
            $data = array(
                "type" => "text",
                "title" => $title,
                "body" => $content,

            );
        }

        try {

            $postId = $client->createPost($blogName, $data)->id;
            $tu = new Tu();
            $tu->tuId = $postId;
            $tu->postId = $pId;
            $tu->blogName = $blogName;
            $tu->save();
            return "success";

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    public static function tuWriteS($spostId, $sblogName, $stitle, $scontent, $simage, $simagetype, $type)
    {
        $blogName = $sblogName;
        $title = $stitle;
        $content = $scontent;
        $pId = $spostId;
        $image = url('') . '/uploads/' . $simage;
        $imagepost = $simagetype;
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        $log = new OptLog();
        if ($imagepost == 'yes') {
            $data = array(
                "type" => "photo",
                "title" => $title,
                "caption" => $content,
                "source" => $image
            );
        } else {
            $data = array(
                "type" => "text",
                "title" => $title,
                "body" => $content,

            );
        }

        try {

            $postId = $client->createPost($blogName, $data)->id;
            echo $postId;
            $tw = new Tw();
            $tw->twId = $postId;
            $tw->postId = $pId;
            $tw->save();
            $log->postId = $postId;
            $log->from = "Tumblr";
            $log->status = "success";
            $log->type = $type;


        } catch (\Exception $e) {
            return $e->getMessage();
            $log->postId = $postId;
            $log->from = "Tumblr";
            $log->status = "error";
            $log->type = $type;

        }
        $log->save();
    }

    public function tuDelete(Request $re)
    {
        $id = $re->id;
        $blogName = $re->blogName;
        $reBlogKey = $re->reBlogKey;

        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');

        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {
            $client->deletePost($blogName, $id, $reBlogKey);
            echo "success";
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

    }

    public static function tuDel($id)
    {

        if (Tu::where('postId', $id)->exists()) {


            $consumerKey = self::get_value('tuConKey');
            $consumerSecret = self::get_value('tuConSec');
            $token = self::get_value('tuToken');
            $tokenSecret = self::get_value('tuTokenSec');
            $tuId = Tu::where('postId',$id)->value('tuId');
            $blogName = Tu::where('postId',$id)->value('blogName');
            $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
            try {
                $client->deletePost($blogName, $tuId, "");
                Tu::where('postId',$id)->delete();
                return "success";
            } catch (\Exception $ex) {
                echo $ex->getMessage();
            }
        }

    }

    public function tuReblog(Request $re)
    {
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $blogName = self::get_value('tuDefBlog');

        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {
            $blogName = $blogName;
            $postId = $re->postId;
            $reblogKey = $re->reblogKey;
            $client->reblogPost($blogName, $postId, $reblogKey);
            echo "success";
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function tuEdit(Request $re)
    {
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $data = array(
            "type" => "text",
            "title" => $re->title,
            "body" => $re->data
        );

        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {
            $postId = $re->postId;
            $blogName = $re->blogName;
            $client->editPost($blogName, $postId, $data);
            echo "success";
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function tuLike(Request $re)
    {
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {
            $postId = $re->postId;
            $reblogKey = $re->reblogKey;
            $client->like($postId, $reblogKey);
            echo "success";
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function tuFollow(Request $re)
    {
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);

        try {
            $client->follow($re->blogName);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function fbWrite(Request $re)
    {

        $config = new Settings();
        $postId = $re->postId;
        $pageId = $re->pageId;
        $accessToken = $re->accessToken;
        $imagepost = $re->imagepost;
        $sharepost = $re->sharepost;
        $imageName = $re->image;


        $imageUrl = url('') . '/uploads/' . $imageName;


        $link = $re->link;
        $caption = $re->caption;
        $name = $re->title;
        $desciption = $re->description;

        $fb = new Facebook([
            'app_id' => $config->config('fbAppId'),
            'app_secret' => $config->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


//        $content = [
//
//            "message" => $re->data,
//            "link" => "",
//            "picture" => "https://scontent-sit4-1.xx.fbcdn.net/v/t1.0-9/13310554_1715488272046223_9136497093754578104_n.jpg?oh=a1fb32069ff6c4c5fdf751eb8be1a04b&oe=57CB8C14",
//            "name" => "",
//            "caption" => "",
//            "description" => ""
//        ];

        if ($imagepost == 'yes') {
            try {
                $content = [
                    "message" => $re->data,
                    "source" => $fb->fileToUpload(public_path() . "/uploads/" . $imageName),
                    "caption" => $caption
                ];
                $post = $fb->post($pageId . "/photos", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->pageId = $pageId;
                    $fbPost->save();
                }
                return "success";
            } catch (FacebookSDKException $fse) {
                return $fse->getMessage();
            } catch (FacebookResponseException $fre) {
                return $fre->getMessage();
            }
        } else if ($sharepost == 'yes') {


            try {
                $content = [
                    "message" => $re->data,
                    "link" => $link,
                    "picture" => $imageUrl,
                    "name" => $name,
                    "caption" => $caption,
                    "description" => $desciption,
//                    "source" => $fb->fileToUpload(public_path()."/uploads/".$imageName)
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->pageId = $pageId;
                    $fbPost->save();
                }
                return "success";
            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            } catch (FacebookResponseException $fre) {
                return $fre->getMessage();
            }
        } else {

            try {
                $content = [
                    "message" => $re->data
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->pageId = $pageId;
                    $fbPost->save();
                }
                return "success";
            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            } catch (FacebookResponseException $fre) {
                return $fre->getMessage();
            }
        }


    }

    public function fbgwrite(Request $re)
    {
        $config = new Settings();
        $postId = $re->postId;
        $groupId = $re->groupId;
        $accessToken = Data::get('fbAppToken');
        $imagepost = $re->imagepost;
        $sharepost = $re->sharepost;
        $textpost = $re->textpost;
        $imageName = $re->image;
        $imageUrl = url('') . '/uploads/' . $imageName;
        $link = $re->link;
        $caption = $re->caption;
        $name = $re->title;
        $desciption = $re->description;

        $fb = new Facebook([
            'app_id' => $config->config('fbAppId'),
            'app_secret' => $config->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        if ($imagepost == 'yes') {
            try {
                $content = [
                    "message" => $re->data,
                    "source" => $fb->fileToUpload(public_path() . "/uploads/" . $imageName),
                    "caption" => $caption
                ];
                $post = $fb->post($groupId . "/photos", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbg = new Fbgr();
                    $fbg->postId = $postId;
                    $fbg->fbId = $id['id'];
                    $fbg->fbGroupId = $groupId;
                    $fbg->save();
                    return "success";
                }

            } catch (FacebookSDKException $fse) {
                return $fse->getMessage();
            }
            catch (\Exception $e){
                return $e->getMessage();
            }
        } else if ($sharepost == 'yes') {

            try {
                $content = [
                    "message" => $re->data,
                    "link" => $link,
                    "picture" => $imageUrl,
                    "name" => $name,
                    "caption" => $caption,
                    "description" => $desciption
                ];
                $post = $fb->post($groupId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbg = new Fbgr();
                    $fbg->postId = $postId;
                    $fbg->fbId = $id['id'];
                    $fbg->fbGroupId = $groupId;
                    $fbg->save();

                }
                return "success";
            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            } catch (FacebookResponseException $fre) {
                return $fre->getMessage();
            }

        } else {
            try {
                $content = [
                    "message" => $re->data
                ];
                $post = $fb->post($groupId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbg = new Fbgr();
                    $fbg->postId = $postId;
                    $fbg->fbId = $id['id'];
                    $fbg->fbGroupId = $groupId;
                    $fbg->save();
                }
                return "success";
            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            } catch (FacebookResponseException $fre) {
                return $fre->getMessage();
            }
        }
    }

    /**
     * @param $spostId
     * @param $spageId
     * @param $spageToken
     * @param $stitle
     * @param $scaption
     * @param $slink
     * @param $simage
     * @param $sdescription
     * @param $scontent
     * @param $simagetype
     * @param $ssharetype
     * @return string
     */
    public static function fbWriteS($spostId, $spageId, $spageToken, $stitle, $scaption, $slink, $simage, $sdescription, $scontent, $simagetype, $ssharetype, $scheduleType)
    {
        $config = new Settings();
        $log = new OptLog();
        $postId = $spostId;
        $pageId = $spageId;
        $accessToken = $spageToken;
        $imagepost = $simagetype;
        $sharepost = $ssharetype;

        $imageName = $simage;
        $imageUrl = url('') . '/uploads/' . $imageName;
        $link = $slink;
        $caption = $scaption;
        $name = $stitle;
        $desciption = $sdescription;

        $fb = new Facebook([
            'app_id' => $config->config('fbAppId'),
            'app_secret' => $config->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        if ($imagepost == 'yes') {
            try {
                $content = [
                    "message" => $scontent,
                    "source" => $fb->fileToUpload(public_path() . "/uploads/" . $imageName),
                    "caption" => $caption
                ];
                $post = $fb->post($pageId . "/photos", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->save();
                }
                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "success";

            } catch (FacebookSDKException $fse) {
                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "error";
            } catch (FacebookResponseException $fre) {
                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "error";
            }
        } else if ($sharepost == 'yes') {

            try {
                $content = [
                    "message" => $scontent,
                    "link" => $link,
                    "picture" => $imageUrl,
                    "name" => $name,
                    "caption" => $caption,
                    "description" => $desciption
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->save();
                }
                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "success";
            } catch (FacebookSDKException $fse) {

                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "error";
            } catch (FacebookResponseException $fre) {
                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "error";
            }

        } else {
            try {
                $content = [
                    "message" => $scontent
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->save();
                }
                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "success";
            } catch (FacebookSDKException $fse) {

                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "error";
            } catch (FacebookResponseException $fre) {
                $log->postId = $postId;
                $log->type = $scheduleType;
                $log->from = "Facebook Page";
                $log->status = "error";
            }
        }
        $log->save();

    }


    /**
     * @param $spostId
     * @param $spageId
     * @param $stitle
     * @param $scaption
     * @param $slink
     * @param $simage
     * @param $sdescription
     * @param $scontent
     * @param $simagetype
     * @param $ssharetype
     *
     * write facebook group ( schedule )
     */
    public static function fbgWriteS($spostId, $spageId, $stitle, $scaption, $slink, $simage, $sdescription, $scontent, $simagetype, $ssharetype)
    {
        $config = new Settings();
        $log = new OptLog();
        $postId = $spostId;
        $pageId = $spageId;
        $accessToken = Data::get('fbAppToken');
        $imagepost = $simagetype;
        $sharepost = $ssharetype;

        $imageName = $simage;
        $imageUrl = url('') . '/uploads/' . $imageName;
        $link = $slink;
        $caption = $scaption;
        $name = $stitle;
        $desciption = $sdescription;

        $fb = new Facebook([
            'app_id' => $config->config('fbAppId'),
            'app_secret' => $config->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        if ($imagepost == 'yes') {
            try {
                $content = [
                    "message" => $scontent,
                    "source" => $fb->fileToUpload(public_path() . "/uploads/" . $imageName),
                    "caption" => $caption
                ];
                $post = $fb->post($pageId . "/photos", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->save();
                }
                $log->postId = $postId;
                $log->status = "success";
                $log->from = "Facebook Group";

            } catch (FacebookSDKException $fse) {
                $log->postId = $postId;
                $log->status = "error";
                $log->from = "Facebook Group";
            } catch (FacebookResponseException $fre) {
                $log->postId = $postId;
                $log->status = "error";
                $log->from = "Facebook Group";
            }
        } else if ($sharepost == 'yes') {

            try {
                $content = [
                    "message" => $scontent,
                    "link" => $link,
                    "picture" => $imageUrl,
                    "name" => $name,
                    "caption" => $caption,
                    "description" => $desciption
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->save();
                }
                $log->postId = $postId;
                $log->from = "Facebook Group";
                $log->status = "success";
            } catch (FacebookSDKException $fse) {

                $log->postId = $postId;
                $log->from = "Facebook Group";
                $log->status = "error";
            } catch (FacebookResponseException $fre) {
                $log->postId = $postId;
                $log->from = "Facebook Group";
                $log->status = "error";
            }

        } else {
            try {
                $content = [
                    "message" => $scontent
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->save();
                }
                $log->postId = $postId;
                $log->from = "Facebook Group";
                $log->status = "success";
            } catch (FacebookSDKException $fse) {

                $log->postId = $postId;
                $log->status = "error";
                $log->from = "Facebook Group";
            } catch (FacebookResponseException $fre) {
                $log->postId = $postId;
                $log->status = "error";
                $log->from = "Facebook Group";
            }
        }
        $log->save();

    }


    public function twDelete(Request $re)
    {
        $id = $re->id;
        $consumerKey = self::get_value('twConKey');
        $consumerSecret = self::get_value('twConSec');
        $accessToken = self::get_value('twToken');
        $tokenSecret = self::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $twitter->destroy($id);
            echo "success";
        } catch (\TwitterException $te) {
            echo $te->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    public static function twDel($id)
    {
        if (Tw::where('postId', $id)->exists()) {
            $twPostId = Tw::where('postId', $id)->value('twId');
            $consumerKey = self::get_value('twConKey');
            $consumerSecret = self::get_value('twConSec');
            $accessToken = self::get_value('twToken');
            $tokenSecret = self::get_value('twTokenSec');

            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
            try {
                $twitter->destroy($twPostId);
                Tw::where('postId',$id)->delete();
                return "Delete form twitter : success";
            } catch (\TwitterException $te) {
                return "Delete form twitter : error";
//                return $te->getMessage();
            } catch (\Exception $e) {
                return "Delete form twitter : error";
//                return $e->getMessage();
            }
        } else {
//            return "Twitter post could not found";
        }

    }


    /**
     * @param $consumerKey
     * @param $consumerSecret
     * @param $token
     * @param $tokenSecret
     * @return string
     */
    public function tuGetBlogName($consumerKey, $consumerSecret, $token, $tokenSecret)
    {
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        $html = "";
        foreach ($client->getUserInfo()->user->blogs as $blog) {
            $html .= "<option value='$blog->name'>" . $blog->name . "</option>" . "\n";
        }
        return $html;
    }

    public function postSave(Request $re)
    {

        $content = $re->data;
        $title = $re->title;
        $postId = $re->postId;
        try {
            $add = new Allpost();
            $add->title = $title;
            $add->content = $content;
            $add->postId = $postId;
            $add->save();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addSchedule(Request $re)
    {
        $postId = $re->postId;
        $title = $re->title;
        $caption = $re->caption;
        $link = $re->link;
        $image = $re->image;
        $data = $re->status;
    }

    public function liWrite(Request $request)
    {
        $linkedIn = new LinkedIn(Data::get('liClientId'), Data::get('liClientSecret'));


    }

}
