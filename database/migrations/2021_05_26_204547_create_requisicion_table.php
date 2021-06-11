<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('destino')->nullable();    
            $table->date('fecha')->nullable();    
            $table->string('necesidad')->nullable(); 
            $table->string('estado')->nullable();    
            $table->bigInteger('proyecto_id')->unsigned(); 

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
        Schema::dropIfExists('requisicion');
    }
}
