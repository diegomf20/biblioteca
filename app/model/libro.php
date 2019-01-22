<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class libro extends Model
{
    protected $table='libro';
    
    public function bloque(){
        return $this->belongsTo('App\model\bloque');
    }
    public function categoria(){
        return $this->belongsTo('App\model\categoria');
    }

    public function scopeNombre($query, $name)
    {
        if( trim($name) != ""){
            $query->where("titulo", "LIKE", "%$name%");
        }
    }

}
