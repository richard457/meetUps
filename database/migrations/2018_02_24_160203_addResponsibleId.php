<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponsibleId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendaDetails', function (Blueprint $table) {
            $table->string('responsible_id')->nullable();
            $table->string('responsible_email')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agendaDetails',function(Blueprint $table){
            $table->dropColumn('responsible_id');
            $table->dropColumn('responsible_email');
        });
    }
}
