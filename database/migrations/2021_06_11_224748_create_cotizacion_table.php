<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('destino')->nullable();    
            $table->date('fecha')->nullable();    
            $table->string('necesidad')->nullable(); 
            $table->bigInteger('proveedor_id')->unsigned();    
            $table->bigInteger('requisicion_id')->unsigned(); 
            $table->string('estado')->default("0");

            $table->foreign('requisicion_id')->references('id')->on('requisicion');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacion');
    }
}
