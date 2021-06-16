<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fechaorden');
            $table->string('lugar')->nullable();  
            $table->bigInteger('admin_contrato_id')->unsigned();
            $table->bigInteger('requisicion_id')->unsigned();
            $table->bigInteger('cotizacion_id')->unsigned();
            $table->bigInteger('proveedor_id')->unsigned();
            $table->string('estado')->nullable();     

            $table->foreign('admin_contrato_id')->references('id')->on('admin_contrato');
            $table->foreign('requisicion_id')->references('id')->on('requisicion');
            $table->foreign('cotizacion_id')->references('id')->on('cotizacion');
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
        Schema::dropIfExists('orden');
    }
}
