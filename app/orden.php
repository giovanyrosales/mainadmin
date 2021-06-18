<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orden extends Model
{
    protected $table = 'orden';
    protected $fillable = [
        'admin_contrato_id', 'fechaorden', 'lugar', 'requisicion_id', 'cotizacion_id', 'estado', 'proveedor_id'
    ];
}
