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
        $username = "prappo_prince";
        $password = "bangladesh1993";
        $this->instagram->setUser($username,$password);
        $this->instagram->login();

    }

    public function index(){

        $i = $this->instagram;

        print_r($i->getSelfUserFollowers());
    }

    public function test(){
        print_r($this->instagram->getSelfUsersFollowing());
    }

}
