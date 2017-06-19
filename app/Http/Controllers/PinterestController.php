<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use seregazhuk\PinterestBot\Factories\PinterestBot;

class PinterestController extends Controller
{
    //
    public function index()
    {
        $pinterest = PinterestBot::create();
        $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));
        $pins = $pinterest->pins->search('bangladesh')->toArray();
        $searchInPins = $pinterest->pins->searchInMyPins('islam')->toArray();
        $searchInPeople = $pinterest->pinners->search('food')->toArray();
//    $boards = $pinterest->pinners->search('islam')->toArray();

        print_r($searchInPeople);
    }

    public function scraperIndex()
    {
        if(!Data::myPackage('pinterest')){
            return view('errors.404');
        }

        return view('pinScraper');
    }

    public function scraper(Request $request)
    {


    }


}
