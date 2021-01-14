<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class linea extends Model
{
    protected $table = 'linea';
    protected $fillable = [
        'codigo', 'nombre'
    ];
}
