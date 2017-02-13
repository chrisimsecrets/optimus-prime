<?php

namespace App\Http\Controllers;

use App\OptSchedul;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /*this code for next version */

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = OptSchedul::where('userId',Auth::user()->id)->get();
        return view('schedule', compact('data'));
    }

    /**
     * @param Request $re
     * @return string
     */
    public function addSchedule(Request $re)
    {

        $title = $re->title;
        $caption = $re->caption;
        $link = $re->link;
        $image = $re->image;
        $description = $re->description;
        $status = $re->status;
        $postId = $re->postId;
        $time = $re->time;
        $fb = $re->fb;
        $fbg = $re->fbg;
        $tw = $re->tw;
        $tu = $re->tu;
        $instagram = $re->instagram;
        $linkedin = $re->linkedin;
        $pageId = $re->pageId;
        $pageToken = $re->pageToken;
        $blogName = $re->blogName;
        $groupId = $re->groupId;
        $wp = $re->wp;
        $imagetype = $re->imagetype;
        $sharetype = $re->sharetype;

        if ($status == "") {
            return "Please write something";
        }
        $schedule = new OptSchedul();
        try {
            $schedule->title = $title;
            $schedule->caption = $caption;
            $schedule->link = $link;
            $schedule->image = $image;
            $schedule->description = $description;
            $schedule->content = $status;
            $schedule->postId = $postId;
            $schedule->$time = $time;
            $schedule->fb = $fb;
            $schedule->tw = $tw;
            $schedule->tu = $tu;
            $schedule->fbg = $fbg;
            $schedule->wp = $wp;
            $schedule->instagram = $instagram;
            $schedule->linkedin = $linkedin;
            $schedule->groupId = $groupId;
            $schedule->pageId = $pageId;
            $schedule->pageToken = $pageToken;
            $schedule->blogName = $blogName;
            $schedule->imagetype = $imagetype;
            $schedule->sharetype = $sharetype;
            $schedule->userId = Auth::user()->id;
            $schedule->save();
            echo "success";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param Request $re
     */
    public function sdel(Request $re)
    {

        $id = $re->id;

        try {
            OptSchedul::where('id', $id)->delete();
            echo "success";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param Request $re
     * @return string
     */
    public function sedit(Request $re){
        $id = $re->id;
        $title = $re->title;
        $content = $re->data;
        $type = $re->type;
        try{
            OptSchedul::where('id',$id)->update(['title'=>$title,'content'=>$content,'type'=>$type]);
            return "success";

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
