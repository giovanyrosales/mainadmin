<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cotizacion extends Model
{
    protected $table = 'cotizacion';
    protected $fillable = [
        'destino', 'fecha', 'necesidad', 'proveedor_id', 'requisicion_id','estado'
    ];
}
