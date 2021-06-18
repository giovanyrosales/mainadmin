<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class det_cotizacion extends Model
{
    protected $table = 'det_cotizacion';
    protected $fillable = [
        'cantidad', 'unidadmedida', 'descripcion', 'preciounit', 'cod_presup','cotizacion_id','estado'    
    ];
}
