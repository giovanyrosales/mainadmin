<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bitacora extends Model
{
    protected $table = 'bitacora';
    protected $fillable = [
        'num', 'fecha', 'observaciones', 'proyecto_id'
    ];
}
