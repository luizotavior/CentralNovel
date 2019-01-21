<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNGenerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_generos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('genero_id')->unsigned();
            $table->foreign('genero_id')->
                references('id')->
                on('generos');
            //Novel
            $table->integer('novel_id')->unsigned()->nullable();
            $table->foreign('novel_id')->
                references('id')->
                on('novels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('n_generos');
    }
}
