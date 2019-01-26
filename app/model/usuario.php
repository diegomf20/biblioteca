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

    public function rol(){
        return $this->belongsTo('App\Roles');
    }

    public function isAdmin(){
        if($this->rol_id === 1)
            return true; 
        else 
            return false; 
    }

    public function isUser(){
        if($this->rol_id === 2)
            return true; 
        else 
            return false; 
    }

    /* public function hasRol($nombre){
        
        if($this->rol->nombre === $nombre)
            return true; 
        else 
            return false; 
    } */
}


