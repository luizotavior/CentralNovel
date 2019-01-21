<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nota')->nullable();
            //Usuario
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->
                references('id')->
                on('users');
            //Novel
            $table->integer('novel_id')->unsigned()->nullable();
            $table->foreign('novel_id')->
                references('id')->
                on('novels');
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
        Schema::dropIfExists('n_notas');
    }
}
