<?php

namespace App\Http\Controllers;

use App\OptLog;
use Illuminate\Http\Request;

use App\Http\Requests;


class OptLogs extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $datas = OptLog::all();
        return view('schedules_log', compact('datas'));
    }

    /**
     * @param Request $re
     * @return string
     */
    public function logDel(Request $re)
    {
        $id = $re->id;
        try {
            OptLog::where('id', $id)->delete();
            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function delAll()
    {
        try {
            OptLog::truncate();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
