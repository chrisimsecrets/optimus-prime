<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CoreController extends Controller
{
    //

    public static function getLang()
    {
        try {

            return Auth::user()->lang;
        } catch (\Exception $exception) {
            return "en";
        }


    }

}
