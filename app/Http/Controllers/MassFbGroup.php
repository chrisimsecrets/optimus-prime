<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;

use App\Http\Requests;

class MassFbGroup extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groups = \App\MassFbGroup::all();
        return view('fbmassgroup', compact('groups'));
    }

    /**
     * @param Request $re
     * @return string
     */
    public function massPost(Request $re)
    {

        $msg = $re->data;


        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $publicGroups = \App\MassFbGroup::all();

        try {
            foreach ($publicGroups as $group) {
                $response = $fb->post($group->groupId . '/feed', ['message' => $msg], Data::get('fbAppToken'))->getDecodedBody();
                if (isset($response['id'])) {
                    echo $response['id'] . "<br>";
                }

            }


        } catch (FacebookSDKException $e) {
            return $e->getMessage();
        }


    }

    /**
     * @param Request $re
     * @return string
     */
    public function saveGroup(Request $re)
    {
        $id = $re->groupId;
        $name = $re->groupName;
        try {

            $group = new \App\MassFbGroup();
            $group->groupId = $id;
            $group->groupName = $name;
            $group->save();
            return "success";

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}


