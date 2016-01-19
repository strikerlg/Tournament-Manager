<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments_games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id');
            $table->foreign('game_id')->references('id')->on('games');
            $table->integer('tournament_id');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
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
        Schema::drop('tournaments_games');
    }
}
