<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePartidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_partida', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('cantidad', 8, 2);
            $table->bigInteger('material_id')->unsigned();
            $table->string('unidad')->nullable();    
            $table->bigInteger('partida_id')->unsigned();
            $table->string('estado')->nullable();     
            

            $table->foreign('partida_id')->references('id')->on('partida');
            $table->foreign('material_id')->references('id')->on('materiales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_partida');
    }
}
