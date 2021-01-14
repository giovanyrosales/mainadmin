<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fuentef extends Model
{
    protected $table = 'fuentef';
    protected $fillable = [
        'codigo', 'nombre'
    ];
}
