<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materiales extends Model
{
    protected $table = 'materiales';
    protected $fillable = [
        'cod', 'nombre', 'unidad', 'pu', 'clasificacion'
    ];
}
