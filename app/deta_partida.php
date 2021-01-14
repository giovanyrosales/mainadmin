<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deta_partida extends Model
{
    protected $table = 'detalle_partida';
    protected $fillable = [ 'cantidad', 'material_id', 'unidad', 'partida_id', 'estado' ];
}
