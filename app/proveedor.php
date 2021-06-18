<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = [
        'nombre', 'telefono', 'nit', 'nrc'
    ];
}
