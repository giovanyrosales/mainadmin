<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialesProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiales_proyecto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('cantidad', 8, 2);
            $table->bigInteger('material_id')->unsigned();    
            $table->bigInteger('proyecto_id')->unsigned();
            $table->string('estado')->nullable();     
            

            $table->foreign('proyecto_id')->references('id')->on('proyecto');
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
        Schema::dropIfExists('materiales_proyecto');
    }
}
