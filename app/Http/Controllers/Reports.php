<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Reports extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }
    public function index(){
        return view('reports');
    }
}
