<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlackBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slack_bots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->text('answer');
            $table->string('channel');
            $table->string('accuracy')->nullable()->default(null);
            $table->string('email')->nullable();
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
        Schema::drop('slack_bots');
    }
}
