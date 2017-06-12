<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use seregazhuk\PinterestBot\Factories\PinterestBot;

class PinterestController extends Controller
{
    //
    public function index(){
    $pinterest = PinterestBot::create();
    $pinterest->auth->login('prappo.prince@gmail.com','bangladesh1993');
//    $pins = $pinterest->pins->search('bangladesh')->toArray();
//    $boards = $pinterest->pinners->search('islam')->toArray();
    $inbox = $pinterest->inbox->sendEmail('prappo.prince@outlook.com',"What the hell you are doing man ?");
    print_r($inbox);
    }
}
