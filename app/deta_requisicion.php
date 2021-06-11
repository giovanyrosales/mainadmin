<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deta_requisicion extends Model
{   
    protected $table = 'det_requisicion';
    protected $fillable = [
        'cantidad', 'unidadmedida', 'descripcion', 'requisicion_id', 'estado'
    ];
}
