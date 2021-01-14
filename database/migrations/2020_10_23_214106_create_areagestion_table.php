<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreagestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areagestion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('linea_id')->unsigned();
            $table->string('codigo')->nullable();     
            $table->string('nombre')->nullable();     

            $table->foreign('linea_id')->references('id')->on('linea');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areagestion');
    }
}
