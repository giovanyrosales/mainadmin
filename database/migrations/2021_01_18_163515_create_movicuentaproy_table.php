<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovicuentaproyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movicuentaproy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cuentaproy_id')->unsigned();           
            $table->decimal('aumenta', 8, 2)->nullable();
            $table->decimal('disminuye', 8, 2)->nullable();
            $table->date('fecha');
            $table->bigInteger('proyecto_id')->unsigned();  
            $table->string('reforma')->nullable();        


            $table->foreign('proyecto_id')->references('id')->on('proyecto');
            $table->foreign('cuentaproy_id')->references('id')->on('cuentaproy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movicuentaproy');
    }
}
