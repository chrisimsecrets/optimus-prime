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
            $this->instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }

    /**
     * My feed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $i = $this->instagram;
        $datas = $i->getSelfUserFeed();
        return view('instagram', compact('datas'));
    }

    /**
     * Home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $datas = $this->instagram->timelineFeed();

        return view('instagramTimeline', compact('datas'));
    }


    /**
     * Popular feed according to user likes and views
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function popular()
    {

        $i = $this->instagram;
        $datas = $i->getPopularFeed();

        return view('instagramPopular', compact('datas'));
    }

    /**
     * Get followers count
     * @return string
     */
    public function getFollowers()
    {
        try {
            return $this->instagram->getSelfUsernameInfo()->user->follower_count;
        } catch (\Exception $exception) {
            return "Error";
        }

    }

    /**
     * Get following count
     * @return string
     */
    public function getFollowing()
    {
        try {
            return $this->instagram->getSelfUsernameInfo()->user->following_count;
        } catch (\Exception $exception) {
            return "Error";
        }

    }

    /**
     * Get the users activity whome we follow
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFollowingUserActivity()
    {
        $data = $this->instagram->getFollowingRecentActivity();
        $datas = $data->fullResponse->stories;
//        print_r($datas->fullResponse->stories);
////        exit;
        return view('instagramFollowingActivity', compact('datas'));
    }


    public function test()
    {
        $i = $this->instagram;

        $datas = $i->searchFBLocation('dhaka');
        print_r($datas);
    }

    /**
     * Write new post to instagram
     * @param Request $request
     * @return string
     */
    public function write(Request $request)
    {
        try {
            $this->instagram->uploadPhoto(public_path() . "/uploads/" . $request->image, $request->caption);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function writef($image, $caption)
    {
        try {
            $this->instagram->uploadPhoto(public_path() . "/uploads/" . $image, $caption);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function delete(Request $request)
    {
        try {
            $this->instagram->deleteMedia($request->id);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function deletef($id)
    {
        try {
            $this->instagram->deleteMedia($id);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function like(Request $request)
    {
        try {
            $this->instagram->like($request->id);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function likef($id)
    {
        try {
            $this->instagram->like($id);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function comment(Request $request)
    {
        try {
            $this->instagram->comment($request->id, $request->text);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function commentf($id, $text)
    {
        try {
            $this->instagram->comment($id, $text);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function follow(Request $request)
    {
        try {
            $this->instagram->follow($request->userId);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function followf($userId)
    {
        try {
            $this->instagram->follow($userId);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function unfollow(Request $request)
    {
        try {
            $this->instagram->unfollow($request->userId);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function messagef($ids = array(), $messgae)
    {
        if ($messgae == "") {
            return "Message can't be empty";
        }
        try {
            $this->instagram->direct_message($ids, $messgae);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }

    public function message(Request $request)
    {
        if ($request->messgae == "") {
            return "Message can't be empty";
        }
        try {
            $this->instagram->direct_message($request->ids, $request->messgae);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function getMediaInfoIndex()
    {
        return view('instagramMediaInfo');
    }

    public function getMediaInfo($mediaId)
    {
        $datas = $this->instagram->mediaInfo($mediaId);
//        print_r($datas);
//        exit;
        $data = $datas->items[0];
        return view('instagramMediaInfo', compact('data'));
    }

    public function followers()
    {
        $datas = $this->instagram->getSelfUserFollowers();

        return view('instagramFollowers', compact('datas'));
    }

    public function following()
    {
        $datas = $this->instagram->getSelfUsersFollowing();

        return view('instagramFollowing', compact('datas'));
    }

    public function followBack()
    {
        $insta = $this->instagram;
        $datas = $insta->getSelfUserFollowers();
        $count = 0;
        foreach ($datas->users as $data) {
            try {
                $insta->follow($data->pk);
                $count++;
            } catch (\Exception $exception) {

            }


        }
        return "Now you are following $count users";
    }

    public function followByTag(Request $request)
    {

        $insta = $this->instagram;
        $datas = $insta->getHashtagFeed($request->tag);
        $numberOfResults = $datas->num_results;
        $count = 0;
        foreach ($datas->ranked_items as $data) {
            try {
                $insta->follow($data->user->pk);
                $count++;
            } catch (\Exception $exception) {
            }


        }
        return "Number of top ranked results $numberOfResults and you are following $count user";

    }

    public function unfollowAll()
    {
        $insta = $this->instagram;
        $datas = $insta->getSelfUsersFollowing();
        $count = 0;
        foreach ($datas->fullResponse->users as $data) {
            try {
                $insta->unfollow($data->pk);
                $count++;
            } catch (\Exception $exception) {

            }

        }
        return "Unfollowed $count users";
    }

    public function autoComment(Request $request)
    {
        $insta = $this->instagram;
        $count = 0;
        if ($request->type == "home") {
            $datas = $insta->timelineFeed();
            foreach ($datas->feed_items as $data) {
                if (isset($data->media_or_ad)) {
                    $insta->comment($data->media_or_ad->id, $request->comment);
                    $count++;
                }

            }
            return "Commented on $count home posts";
        } elseif ($request->type == "popular") {
            $datas = $insta->getPopularFeed();
            foreach ($datas['items'] as $data) {
                $insta->comment($data['id'], $request->comment);
                $count++;
            }
            return "Commented on $count popular posts";
        } elseif ($request->type == "self") {
            $datas = $insta->getSelfUserFeed();
            foreach ($datas->items as $data) {
                $insta->comment($data->id, $request->comment);
                $count++;
            }
            return "Commented on $count self posts";
        } elseif ($request->type == "hashtag") {
            $datas = $insta->getHashtagFeed($request->tag);
            foreach ($datas->ranked_items as $data){
                $insta->comment($data->id,$request->comment);
                $count++;
            }
            return "Commented on $count hashtag posts";
        }
    }

    public function scraper(Request $request){
        $insta = $this->instagram;
        if($request->type == "tag"){
            $datas = $insta->getHashtagFeed($request->data);
            return view('instaGetHashTagFeed',compact('datas'));
        }
        elseif ($request->type == "user"){
            $datas = $insta->searchUsers($request->data);
            return view('instaSearchUsers',compact('datas'));
        }
        elseif($request->type == "location"){
            $datas = $insta->searchFBLocation($request->data);
            return view('instaSearchLocation',compact('datas'));
        }
    }


    public function getTagFeed()
    {

    }

}
