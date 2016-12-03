<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class Notify extends Controller
{
    //
    /**
     * @param Request $re
     * @return string
     */
    public function insert(Request $re)
    {
        try {
            $notify = new \App\Notify();
            $notify->img = $re->img;
            $notify->title = $re->title;
            $notify->body = $re->body;
            $notify->time = $re->time;
            $notify->url = $re->url;
            $notify->type = $re->type;
            $notify->userId = Auth::user()->id;
            $notify->save();
            return "success";

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $data = \App\Notify::where('userId',Auth::user()->id)->get();
        return view('notify', compact('data'));
    }

    /**
     * @return string
     */
    public function delAll()
    {
        try {
            \App\Notify::where('userId',Auth::user()->id)->truncate();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
