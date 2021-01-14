<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bolson extends Model
{
    protected $table = 'bolson';
    protected $fillable = [
        'nombre', 'fecha', 'montoini', 'cuenta_id', 'saldo'
    ];
}
