<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /*Schema::create('spells', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('champion_id')->references('id')->on('champions');
            $table->string('name');
            $table->text('description');
            $table->text('sanitizedDescription');
            $table->text('tooltip');
            $table->text('sanitizedTooltip');
            $table->integer('image_id');  
            $table->string('resource');
            $table->integer('maxrank');
            $table->string('costType');
            $table->string('costBurn');
            $table->string('cooldownBurn');
            $table->string('rangeBurn');
            $table->string('key');

        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
