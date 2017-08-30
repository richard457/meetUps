<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInviteesTable extends Migration
{

    public function up()
    {
        Schema::create('invitees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('meeting_id');//TODO make it a foreign key once done prototyping

            $table->integer ('user_id');//TODO make it a foreign key once done prototyping the one inviting other users.
            $table->string ('invitee_email');//TODO make it a foreign key once done prototyping
            $table->boolean ('accepted_invitation')->default(false);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('invitees');
    }
}
