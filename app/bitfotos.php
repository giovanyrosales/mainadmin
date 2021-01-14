<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bitfotos extends Model
{
    protected $table = 'bitfotos';
    protected $fillable = [
        'bitacora_id', 'nombre', 'dir'
    ];
}
