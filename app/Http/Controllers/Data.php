<?php

namespace App\Http\Controllers;

use App\FacebookPages;

<<<<<<< HEAD
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> 7bb5360ab9d5fc21c54898805ca3e6cbf3e18527
use Illuminate\Support\Facades\DB;

class Data extends Controller
{

    /**
     * @param $valueOf
     * @return mixed
     * get settings value
     */
    public static function get($valueOf)
    {
        return DB::table('settings')->where('email',Auth::user()->email)->where('field', $valueOf)->value('value');

    }

    /**
     * @param int $pageId
     * @return mixed
     * get facebook page access token from database
     */
    public static function getToken($pageId)
    {
        return DB::table('facebookPages')->where('email',Auth::user()->email)->where('pageId', $pageId)->value('pageToken');

    }

    /**
     * @param int $pageId
     * @return string
     * get page name using page id form database
     */
    public static function getPageName($pageId)
    {
        $data = FacebookPages::where('pageId', $pageId)->where('email',Auth::user()->email)->value('pageName');

        return $data;
    }

    public static function botButton($userId, $data = array())
    {
        $result = "";
        foreach ($data as $d) {
            $result .= '{
                         "type":"postback",
                          "title":"' . $d['question'] . '",
                          "payload":"' . $d['question'] . '"
                          },
                        ';
        }
        $json = '{
                  "recipient":{
                    "id":"' . $userId . '"
                  },
                  "message":{
                    "attachment":{
                      "type":"template",
                      "payload":{
                        "template_type":"button",
                        "text":"Help Menu",
                        "buttons":[' . $result . ']
                      }
                    }
                  }
                }';

        return $json;
    }

    /**
     * @param $text
     * @return string
     */
    public static function shortText($text){
        $small = substr($text, 0, 30);
        return $small." ....";
    }
}
