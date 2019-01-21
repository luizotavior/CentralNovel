<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGConquistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_conquistas', function (Blueprint $table) {
            $table->increments('id');
            //Grupo
            $table->integer('grupo_id')->unsigned()->nullable();
            $table->foreign('grupo_id')->
                references('id')->
                on('grupos');
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
        Schema::dropIfExists('g_conquistas');
    }
}
