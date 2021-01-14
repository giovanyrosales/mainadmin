<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitfotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitfotos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bitacora_id')->unsigned(); 
            $table->string('nombre')->nullable();    
            $table->string('dir')->nullable();     

            $table->foreign('bitacora_id')->references('id')->on('bitacora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitfotos');
    }
}
