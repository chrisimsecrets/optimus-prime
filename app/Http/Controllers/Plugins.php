<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Nwidart\Modules\Facades\Module;
use PhpParser\Node\Expr\Cast\Object_;


class Plugins extends Controller
{
    public function index()
    {
        $data = [];
        $modules = glob(base_path('Modules/') . "*");
        foreach ($modules as $module) {
            $content = file_get_contents($module . "/module.json");
            $json = json_decode($content, true);
            array_push($data, $json);

        }

        // return data to view

    }

    public function action(Request $request)
    {
        $module = Module::find($request->name);

        try {
            if ($request->action == "enable") {
                $module->enable;
                return "success";
            } elseif ($request->action == "disable") {
                $module->disable();
                return "success";
            } elseif ($module->action == "delete") {

                $module->delete();
                return "success";
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public static function menu($menuId){
        $menuData = [];
        $modules = glob(base_path('Modules/') . "*");
        foreach ($modules as $module) {
            $content = file_get_contents($module . "/module.json");
            $json = json_decode($content,true);
            if($menuId == ""){
                if($json['active'] == 1){
                    array_push($menuData,$json);
                }
            }



        }

    }

    public static function is_active($pluginName){

    }
}
