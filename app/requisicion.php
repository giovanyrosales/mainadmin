<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class requisicion extends Model
{   
    protected $table = 'requisicion';
    protected $fillable = [
        'destino', 'fecha', 'necesidad', 'estado', 'proyecto_id'
    ];
}
