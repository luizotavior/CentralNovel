<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNConquistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_conquistas', function (Blueprint $table) {
            $table->increments('id');
            //Novels
            $table->integer('novel_id')->unsigned()->nullable();
            $table->foreign('novel_id')->
                references('id')->
                on('novels');
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
        Schema::dropIfExists('n_conquistas');
    }
}
