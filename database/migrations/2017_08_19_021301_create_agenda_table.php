<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id');
            $table->string ('agenda')->nullable();
            $table->string ('matters')->nullable();
            $table->string ('action')->nullable();
            $table->string ('responsible')->nullable();
            $table->string ('deadline')->nullable();
            $table->string ('meeting_id');
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

        Schema::dropIfExists('agenda');
    }
}
