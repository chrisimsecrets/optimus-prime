<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fbLikes');
            $table->string('twFollowers');
            $table->string('tuFollowers');
            $table->string('wpPosts');
            $table->string('fri');
            $table->string('sat');
            $table->string('sun');
            $table->string('mon');
            $table->string('tu');
            $table->string('wed');
            $table->string('thu');

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
        Schema::drop('dashboards');
    }
}
