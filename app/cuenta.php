<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuenta extends Model
{
    protected $table = 'cuenta';
    protected $fillable = [
        'nombre', 'codigo'
    ];
}
