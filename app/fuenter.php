<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fuenter extends Model
{
    protected $table = 'fuenter';
    protected $fillable = [
        'codigo', 'nombre', 'fuentef_id'
    ];
}
