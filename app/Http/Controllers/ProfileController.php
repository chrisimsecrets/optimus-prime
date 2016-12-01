<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        return view('profile',compact('name','email'));
    }

    public function update(Request $re){
        $name = $re->name;
        $email = $re->email;
        $oldPass = $re->oldPass;
        $newPass = $re->newPass;
        if($newPass == ""){
            User::where('email',Auth::user()->email)->update([
                'email'=>$email,
                'name'=>$name
            ]) ;

            return "success";
        }
        else{
            if($oldPass == ""){
                return "Please input old password";
            }
            else{
                if(Hash::check($oldPass,Auth::user()->password)){
                    User::where('email',Auth::user()->email)->update([
                        'email'=>$email,
                        'name'=>$name,
                        'password'=>bcrypt($newPass)
                    ]);
                    return "success";
                }
                else{
                    return "Old password didn't match";
                }
            }
        }
    }
}
