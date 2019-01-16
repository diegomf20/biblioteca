<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table='usuario';

    public function scopePopular($query)
    {
        return $query->where('titulo', '>', 100);
    }
}


