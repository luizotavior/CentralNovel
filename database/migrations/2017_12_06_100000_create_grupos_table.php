<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->unique();
            $table->longText('descricao')->nullable();
            $table->string('patrocinar')->nullable();
            $table->string('site');
            $table->string('feed')->nullable();
            $table->string('url')->unique();
            $table->enum('status', ['pendente', 'ativado','desativado'])->default('ativado');
            //Categoria
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->
                references('id')->
                on('categorias');
            
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
        Schema::dropIfExists('grupos');
    }
}
