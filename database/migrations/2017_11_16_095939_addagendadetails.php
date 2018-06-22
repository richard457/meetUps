<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addagendadetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string ('matters');
            $table->string ('action');
            $table->string ('deadline');
            $table->string ('responsible');
            $table->integer('agenda_id')->unsigned()->index();
            $table->foreign('agenda_id')->references('id')->on('agenda')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum ('status', ['appending', 'rejected', 'approved'])->default ('appending');
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
        Schema::dropIfExists('agenda_details');
    }
}
