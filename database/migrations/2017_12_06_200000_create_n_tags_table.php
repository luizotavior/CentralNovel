<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_tags', function (Blueprint $table) {
            $table->increments('id');
            //Tag
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->
                references('id')->
                on('tags');
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
        Schema::dropIfExists('n_tags');
    }
}
