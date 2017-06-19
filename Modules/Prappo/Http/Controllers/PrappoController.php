<?php

namespace Modules\Prappo\Http\Controllers;

use App\Http\Controllers\Plugins;
use App\User;
use Badcow\LoremIpsum\Generator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Eden\Sqlite;
use Illuminate\Support\Facades\Auth;

class PrappoController extends Controller
{

    function __construct()
    {
        Plugins::check('Prappo',Auth::user()->id);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
//        $generator = new Generator();
//        $paragraph = $generator->getParagraphs(5);
//        print_r($paragraph);

//        $data = [];
//
//        $plugin1 = [
//            "name"=>"plugin 1",
//            "description" => "bla bal",
//            "link" => "http://google.com",
//            "for" => "optimus prime",
//            "image" => "",
//            "type"=>"free"
//
//        ];
//        $plugin2 =[
//          "name" =>"plugin 2",
//            "description" => "lol lol"
//        ];
//        array_push($data,$plugin1,$plugin2);
//        $json = json_encode($data);
//        print_r($json);

//        return view('prappo::index');



    }

    public function menu(){
        return view('prappo::menu');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('prappo::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('prappo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('prappo::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
