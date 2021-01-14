<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movibolson extends Model
{
    protected $table = 'movibolson';
    protected $fillable = [
        'bolson_id', 'cuenta_id', 'aumenta', 'disminuye', 'fecha', 'tipomovi_id', 'proyecto_id'
    ];
}
