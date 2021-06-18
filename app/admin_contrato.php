<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin_contrato extends Model
{
    protected $table = 'admin_contrato';
    protected $fillable = [
        'nombre', 'telefono'
    ];
}
