<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTournamentPlayerRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_matches', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id');
            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournaments');
            $table->integer('player_id');
            $table->foreign('player_id')
                ->references('id')
                ->on('players');
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
        Schema::drop('tournament_matches');
    }
}
