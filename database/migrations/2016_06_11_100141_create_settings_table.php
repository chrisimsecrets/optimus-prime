<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wpUser')->nullable();
            $table->string('wpPassword')->nullable();
            $table->string('wpUrl')->nullable();
            $table->string('tuConKey')->nullable();
            $table->string('tuConSec')->nullable();
            $table->string('tuToken')->nullable();
            $table->string('tuTokenSec')->nullable();
            $table->string('twConKey')->nullable();
            $table->string('twConSec')->nullable();
            $table->string('twToken')->nullable();
            $table->string('twTokenSec')->nullable();
            $table->string('fbAppId')->nullable();
            $table->string('fbAppToken')->nullable();
            $table->string('fbAppSec')->nullable();
            $table->string('tuDefBlog')->nullable();
            $table->string('twUser')->nullable();
            $table->string('fbDefPage')->nullable();
            $table->string('notifyAppId')->nullable();
            $table->string('notifyAppKey')->nullable();
            $table->string('notifyAppSecret')->nullable();
            $table->string('skypeUser')->nullable();
            $table->string('skypePass')->nullable();
            $table->string('liClientId')->nullable();
            $table->string('liClientSecret')->nullable();
            $table->string('liAccessToken')->nullable();
            $table->string('inUser')->nullable();
            $table->string('inPass')->nullable();
            $table->string('inAccessToken')->nullable();
            $table->string('matchAcc')->nullable();
            $table->string('exMsg')->nullable();
            $table->string('slackBotMatchAcc')->nullable();
            $table->string('userId')->nullable();
            $table->string('pinUser')->nullable();
            $table->string('pinPass')->nullable();
            $table->string('lang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
