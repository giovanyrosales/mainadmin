<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movicuentaproy extends Model
{
    protected $table = 'movicuentaproy';
    protected $fillable = [
        'cuentaproy_id', 'aumenta', 'disminuye', 'fecha', 'proyecto_id', 'reforma'
    ];
}
