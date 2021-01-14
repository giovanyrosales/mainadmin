<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materiales_proy extends Model
{
    protected $table = 'materiales_proyecto';
    protected $fillable = [ 'cantidad', 'material_id', 'proyecto_id', 'estado' ];
}
