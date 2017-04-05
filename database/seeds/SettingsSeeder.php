<?php

use App\Setting;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        DB::table('settings')->insert(['field' => 'wpUser']);
//        DB::table('settings')->insert(['field' => 'wpPassword']);
//        DB::table('settings')->insert(['field' => 'wpUrl']);
//        DB::table('settings')->insert(['field' => 'tuConKey']);
//        DB::table('settings')->insert(['field' => 'tuConSec']);
//        DB::table('settings')->insert(['field' => 'tuToken']);
//        DB::table('settings')->insert(['field' => 'tuTokenSec']);
//        DB::table('settings')->insert(['field' => 'twConKey']);
//        DB::table('settings')->insert(['field' => 'twConSec']);
//        DB::table('settings')->insert(['field' => 'twToken']);
//        DB::table('settings')->insert(['field' => 'twTokenSec']);
//        DB::table('settings')->insert(['field' => 'fbAppId']);
//        DB::table('settings')->insert(['field' => 'fbAppToken']);
//        DB::table('settings')->insert(['field' => 'fbAppSec']);
//        DB::table('settings')->insert(['field' => 'tuDefBlog']);
//        DB::table('settings')->insert(['field' => 'twUser']);
//        DB::table('settings')->insert(['field' => 'fbDefPage']);
//        DB::table('settings')->insert(['field' => 'lang']);
//        DB::table('settings')->insert(['field' => 'notifyAppId']);
//        DB::table('settings')->insert(['field' => 'notifyAppKey']);
//        DB::table('settings')->insert(['field' => 'notifyAppSecret']);
//        DB::table('settings')->insert(['field' => 'skypeUser']);
//        DB::table('settings')->insert(['field' => 'skypePass']);
//        DB::table('settings')->insert(['field' => 'liClientId']);
//        DB::table('settings')->insert(['field' => 'liClientSecret']);
//        DB::table('settings')->insert(['field' => 'liAccessToken']);
//        DB::table('settings')->insert(['field' => 'matchAcc','value'=>'75']);
//        DB::table('settings')->insert(['field' => 'exMsg','value'=>"Sorry I don't understand"]);
//        DB::table('settings')->insert(['field' => 'slackBotMatchAcc','value'=>'75']);
//        DB::table('settings')->insert(['field' => 'email','value'=>'admin@email.com']);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'type' => 'admin',
            'theme' => 'skin-red-light',
        ]);

        Setting::create([
            'userId' => User::where('email', 'admin@email.com')->value('id')
        ]);

        \App\Package::create([
            'userId' => User::where('email', 'admin@email.com')->value('id')
        ]);

        \App\SoftwareSettings::create(['key' => 'name']);
        \App\SoftwareSettings::create(['key' => 'logo']);
        \App\SoftwareSettings::create(['key' => 'footerText']);
        \App\SoftwareSettings::create(['key' => 'footerTextLink']);
        \App\SoftwareSettings::create(['key' => 'footerVersion']);
    }
}
