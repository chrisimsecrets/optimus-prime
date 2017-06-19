<?php

namespace App\Http\Controllers;

use App\Package;
use App\PluginsRecord;
use App\Setting;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function userList()
    {
        if (Auth::user()->type != 'admin') {
            return view('errors.404');
        }
        $data = User::all();
        return view('userlist', compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function addUserIndex()
    {
        if (Auth::user()->type != 'admin') {
            return view('errors.404');
        }
        return view('adduser');
    }

    public function adminDashboard()
    {
        if (Auth::user()->type != 'admin') {
            return view('errors.404');
        }
        return view('admin');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function userAdd(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return "Email already exists";
        }
        if ($request->name == "") {
            return "Name required";
        }
        if ($request->password == "") {
            return "Password required";
        }
        try {
            /*
             * Creating new user
             *
             * */

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->type = 'user';
            $user->status = 'active';
            $user->save();
            //create pakcage for user

            $package = new Package();
            $package->userId = User::where('email', $request->email)->value('id');
            $package->fb = $request->fb;
            $package->tw = $request->tw;
            $package->tu = $request->tu;
            $package->wp = $request->wp;
            $package->ln = $request->ln;
            $package->in = $request->in;
            $package->fbBot = $request->fbBot;
            $package->slackBot = $request->slackBot;
            $package->contacts = $request->contacts;
            $package->save();

            // creating settings data for this user
            $settings = new Setting();
            $settings->userId = User::where('email', $request->email)->value('id');
            $settings->save();

            return "success";


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function userEdit($id)
    {
        if (Auth::user()->type != 'admin') {
            return view('errors.404');
        }
        $name = User::where('id', $id)->value('name');
        $email = User::where('id', $id)->value('email');

//        get plugins list

        if (Auth::user()->type != 'admin') {
            return view('errors.404');
        }
        $plugins = [];
        $modules = glob(base_path('Modules/') . "*");
        foreach ($modules as $module) {
            if (strpos($module, '.') !== false || strpos($module, '__') !== false) {
//                not folder
            } else {
                $content = file_get_contents($module . "/module.json");
                $json = json_decode($content, true);
                array_push($plugins, $json);
            }


        }

        return view('useredit', compact('name', 'email', 'id', 'plugins'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function userUpdate(Request $request)
    {

        if ($request->name == "" || $request->email == "") {
            return "Name and Email field can't be empty";
        }
        if ($request->password == "") {
            try {
                User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);


            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            try {
                User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);

            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        try {
            Package::where('userId', $request->id)->update([
                'fb' => $request->fb,
                'tw' => $request->tw,
                'tu' => $request->tu,
                'wp' => $request->wp,
                'ln' => $request->ln,
                'in' => $request->in,
                'fbBot' => $request->fbBot,
                'pinterest' => $request->pinterest,
                'slackBot' => $request->slackBot,
                'contacts' => $request->contacts
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        return "success";
    }

    /**
     * @param Request $request
     * @return string
     */
    public function userDel(Request $request)
    {
        $userType = User::where('id', $request->id)->value('type');
        if ($userType == 'admin') {
            return "You can't deactive admin account";
        }

        try {
            if (User::where('id', $request->id)->value('status') == 'active') {
                User::where('id', $request->id)->update([
                    'status' => 'deactive'
                ]);
            } else {
                User::where('id', $request->id)->update([
                    'status' => 'active'
                ]);
            }

            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function adminIndex()
    {
        if (Auth::user()->type != 'admin') {
            return view('errors.404');
        }
        return view('admin');
    }
}
