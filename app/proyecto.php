<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    protected $table = 'proyecto';
    protected $fillable = [
        'codigo', 'nombre', 'ubicacion', 'fuentef', 'contraparte','fechaini', 'fechafin', 'fecha', 'areagestion', 'linea', 'fuenter', 'naturaleza', 'ejecutor', 'formulador',  'supervisor', 'encargado', 'codcontable', 'acuerdoapertura', 'acuerdocierre', 'estado'
    ];
}
