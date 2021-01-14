<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class partida extends Model
{
    protected $table = 'partida';
    protected $fillable = [ 'item', 'nombre', 'cantidadp', 'proyecto_id', 'estado' ];
}
