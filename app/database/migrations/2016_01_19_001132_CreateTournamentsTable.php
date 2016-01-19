<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('begin')->default(Carbon\Carbon::now());
            $table->date('finish')->default(Carbon\Carbon::now());
            $table->boolean('has_ended')->default(false);
            $table->integer('created_by');
            $table->foreign('created_by')->references('id')->on('administrators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tournaments');
    }
}
