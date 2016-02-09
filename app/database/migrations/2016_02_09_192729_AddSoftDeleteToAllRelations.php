<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToAllRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrators', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('games', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('matches', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('players', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('rankings', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tournaments', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tournaments_games', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tournaments_players', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administrators', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('games', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('matches', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('players', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('rankings', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('tournaments', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('tournaments_games', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('tournaments_players', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
