<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partida', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item')->nullable();    
            $table->string('nombre')->nullable();    
            $table->string('cantidadp')->nullable(); 
            $table->bigInteger('proyecto_id')->unsigned();
            $table->string('estado')->nullable();     
            

            $table->foreign('proyecto_id')->references('id')->on('proyecto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partida');
    }
}
