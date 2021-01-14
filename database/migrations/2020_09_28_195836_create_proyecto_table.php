<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo')->unique()->nullable();
            $table->string('nombre');
            $table->string('ubicacion');
            $table->string('fuentef')->nullable();
            $table->string('contraparte')->nullable();
            $table->date('fechaini')->nullable();
            $table->date('fechafin')->nullable();
            $table->date('fecha');
            $table->string('areagestion')->nullable();
            $table->string('linea')->nullable();
            $table->string('fuenter')->nullable();
            $table->string('naturaleza')->nullable();
            $table->string('ejecutor')->nullable();
            $table->string('formulador')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('encargado')->nullable();
            $table->string('codcontable')->nullable();
            $table->string('acuerdoapertura', 100)->nullable();
            $table->string('acuerdocierre', 100)->nullable();
            $table->string('estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto');
    }
}
