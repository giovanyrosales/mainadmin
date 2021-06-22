<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuenter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fuentef_id')->unsigned();
            $table->string('codigo');     
            $table->string('nombre')->nullable();
            

            $table->foreign('fuentef_id')->references('id')->on('fuentef');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuenter');
    }
}
