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
        Schema::table('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->foreign('first_player_id')->references('id')->on('players');
            $table->foreign('second_player_id')->references('id')->on('players');
            $table->foreign('winner')->references('id')->on('players');
            $table->date('begin')->default(Carbon\Carbon::now());
            $table->date('finish')->default(Carbon\Carbon::now());
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
