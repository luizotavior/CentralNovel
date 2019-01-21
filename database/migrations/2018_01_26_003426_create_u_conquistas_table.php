<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUConquistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_conquistas', function (Blueprint $table) {
            $table->increments('id');
            //Usuario
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->
                references('id')->
                on('users');
            //Conquistas
            $table->integer('conquista_id')->unsigned()->nullable();
            $table->foreign('conquista_id')->
                references('id')->
                on('conquistas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_conquistas');
    }
}
