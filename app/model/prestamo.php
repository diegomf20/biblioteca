<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class prestamo extends Model
{
    protected $table='prestamo';

    public function libro(){
        return $this->belongsTo('App\model\libro');
    }
    public function estudiante(){
        return $this->belongsTo('App\model\estudiante');
    }

}
