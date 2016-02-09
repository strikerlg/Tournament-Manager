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
        Schema::create('tournaments_players', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id');
            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournaments');
            $table->integer('player_id');
            $table->foreign('player_id')
                ->references('id')
                ->on('players');
            $table->timestamp('created_at')
                ->default(\Carbon\Carbon::now());
            $table->timestamp('updated_at')
                ->default(\Carbon\Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tournaments_players');
    }
}
