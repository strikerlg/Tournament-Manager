<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMathcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->integer('first_player_id');
            $table->foreign('first_player_id')->references('id')->on('players');
            $table->integer('second_player_id');
            $table->foreign('second_player_id')->references('id')->on('players');
            $table->integer('winner')->nullable();
            $table->foreign('winner')->references('id')->on('players');
            $table->date('begin')->default(Carbon\Carbon::now());
            $table->date('finish')->default(Carbon\Carbon::now());
            $table->integer('created_by');
            $table->foreign('created_by')->references('id')->on('administrators');
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
        Schema::drop('matches');
    }
}
