<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('tu')->nullable();
            $table->string('wp')->nullable();
            $table->string('ln')->nullable();
            $table->string('in')->nullable();
            $table->string('fbBot')->nullable();
            $table->string('slackBot')->nullable();
            $table->string('contacts')->nullable();
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
        Schema::drop('packages');
    }
}
