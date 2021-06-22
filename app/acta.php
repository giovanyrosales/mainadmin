<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class acta extends Model
{
    protected $table = 'acta';
    protected $fillable = [
        'fechaacta', 'orden_id','hora', 'estado'
    ];
}
