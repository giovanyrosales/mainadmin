<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetRequisicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_requisicion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('cantidad', 8, 2);
            $table->string('unidadmedida', 8, 2);
            $table->string('descripcion')->nullable();
            $table->bigInteger('requisicion_id')->unsigned();
            $table->string('estado')->default("0"); 
            

            $table->foreign('requisicion_id')->references('id')->on('requisicion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_requisicion');
    }
}
