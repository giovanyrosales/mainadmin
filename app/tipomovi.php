<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipomovi extends Model
{
    protected $table = 'tipomovi';
    protected $fillable = [ 'nombre' ];
}
