<?php

namespace App\Http\Controllers;

use App\Contacts;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = new Contacts();
        return view('contactList',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addContact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->name == ""){
            return "Contact name required";
        }
        try{
            $contact = new Contacts();
            $contact->name = $request->name;
            $contact->phone = $request->phone;
            $contact->email = $request->email;
            $contact->address = $request->address;
            $contact->about = $request->about;
            $contact->userId = Auth::user()->id;
            $contact->save();
            return "success";
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Contacts::where('id',$id)->get();
        return view('editContact',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            Contacts::where('id',$id)->update([
               'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'about'=>$request->about

            ]);
            return "success";
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
