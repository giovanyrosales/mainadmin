<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_cotizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('cantidad', 8, 2);
            $table->string('unidadmedida', 8, 2);
            $table->string('descripcion')->nullable();
            $table->decimal('preciounit', 10, 4);
            $table->decimal('cod_presup', 8, 0);
            $table->bigInteger('cotizacion_id')->unsigned();
            $table->string('estado')->nullable();     
            

            $table->foreign('cotizacion_id')->references('id')->on('cotizacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_cotizacion');
    }
}
