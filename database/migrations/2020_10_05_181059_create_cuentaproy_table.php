<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaproyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentaproy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('proyecto_id')->unsigned();  
            $table->bigInteger('cuenta_id')->unsigned();     
            $table->decimal('montoini', 8, 2);
            $table->decimal('saldo', 8, 2)->nullable();


            $table->foreign('proyecto_id')->references('id')->on('proyecto');
            $table->foreign('cuenta_id')->references('id')->on('cuenta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentaproy');
    }
}
