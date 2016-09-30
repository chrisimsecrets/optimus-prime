<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptSchedulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opt_scheduls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('postId');
            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('content')->nullable();
            $table->string('fb')->nullable();
            $table->string('fbg')->nullable();
            $table->string('tw')->nullable();
            $table->string('tu')->nullable();
            $table->string('wp')->nullable();
            $table->string('skype')->nullable();
            $table->string('type')->nullable();
            $table->string('pageId')->nullable();
            $table->string('pageToken')->nullable();
            $table->string('groupId')->nullable();
            $table->string('blogName')->nullable();
            $table->string('imagetype')->nullable();
            $table->string('sharetype')->nullable();
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
        Schema::drop('opt_scheduls');
    }
}
