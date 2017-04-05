<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(){
        if(Auth::user()->type != "admin"){
            return "Access denied";
        }
        return view('shop');
    }
}
