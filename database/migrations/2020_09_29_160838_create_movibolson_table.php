<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovibolsonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movibolson', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bolson_id')->unsigned(); 
            $table->bigInteger('cuenta_id')->unsigned();            
            $table->decimal('aumenta', 8, 2)->nullable();
            $table->decimal('disminuye', 8, 2)->nullable();
            $table->date('fecha');
            $table->bigInteger('tipomovi_id')->unsigned();   
            $table->bigInteger('proyecto_id')->unsigned();     


            $table->foreign('proyecto_id')->references('id')->on('proyecto');
            $table->foreign('bolson_id')->references('id')->on('bolson');
            $table->foreign('cuenta_id')->references('id')->on('cuenta');
            $table->foreign('tipomovi_id')->references('id')->on('tipomovi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movibolson');
    }
}
