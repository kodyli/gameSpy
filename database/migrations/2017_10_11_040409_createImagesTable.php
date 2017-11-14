<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /* Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full');
            $table->string('group');
            $table->string('sprite');
            $table->integer('h');
            $table->integer('w'); 
            $table->integer('y'); 
            $table->integer('x');      
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
