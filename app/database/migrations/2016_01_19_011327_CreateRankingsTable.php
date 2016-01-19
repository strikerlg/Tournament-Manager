<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id');
            $table->foreign('player_id')->references('id')->on('players');
            $table->integer('tournament_id');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->integer('score')->default(0);
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
        Schema::table('rankings', function (Blueprint $table) {
            //
        });
    }
}
