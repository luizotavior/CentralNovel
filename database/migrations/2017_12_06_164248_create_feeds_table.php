<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('url');
            $table->longText('descricao')->nullable();
            $table->string('arco')->nullable();
            $table->integer('volume')->nullable();
            $table->string('capitulo')->nullable();
            $table->string('parte')->nullable();
            //Categoria
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->
                references('id')->
                on('categorias');
            //Novel
            $table->integer('novel_id')->unsigned()->nullable();
            $table->foreign('novel_id')->
                references('id')->
                on('novels');
            //Grupo
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->
                references('id')->
                on('grupos');

             $table->datetime('published_at');
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
        Schema::dropIfExists('feeds');
    }
}
