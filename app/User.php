<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table="user";

    public function rol(){
        return $this->belongsTo('App\model\rol');
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

    public function hasRol($nombre){
        
        if($this->rol->nombre === $nombre)
            return true; 
        else 
            return false; 
    }
}
