<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nota')->nullable();
            //Usuario
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->
                references('id')->
                on('users');
            //Grupo
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->
                references('id')->
                on('grupos');
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
        Schema::dropIfExists('g_notas');
    }
}
