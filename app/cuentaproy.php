<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuentaproy extends Model
{
    protected $table = 'cuentaproy';
    protected $fillable = [
        'proyecto_id', 'cuenta_id', 'montoini', 'saldo'
    ];
}
