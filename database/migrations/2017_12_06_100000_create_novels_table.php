<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('sigla')->nullable();
            $table->longText('sinopse')->nullable();
            $table->string('autor')->nullable();
            $table->string('tradutor')->nullable();
            $table->string('editor')->nullable();
            $table->string('url')->unique();
            $table->string('capa')->nullable();
            $table->enum('status', ['pendente', 'ativado','desativado'])->default('ativado');
            //linguagem
            $table->integer('linguagem_id')->unsigned();
            $table->foreign('linguagem_id')->
                references('id')->
                on('linguagens');
            //
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->
                references('id')->
                on('tipos');
            
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
        Schema::dropIfExists('novels');
    }
}
