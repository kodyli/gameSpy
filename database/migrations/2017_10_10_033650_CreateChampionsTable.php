<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChampionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        Schema::create('champions', function (Blueprint $table) {
            $table->primary('id');
            $table->integer('id')->unsigned();
            $table->string('key');
            $table->string('name');
            $table->string('title');
            $table->string('partype');
            $table->text('lore');
            $table->text('blurb');
            $table->integer('passive_id');
            $table->integer('image_id');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('champions');
    }
}
