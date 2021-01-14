<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class areagestion extends Model
{
    protected $table = 'areagestion';
    protected $fillable = [
        'codigo', 'nombre', 'linea_id'
    ];
}
