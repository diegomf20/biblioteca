<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\prestamo;
use Illuminate\Support\Facades\DB;


class AlertaController extends Controller
{
    public function alerta(){
        $data=[];
        $prestamoPendiente=prestamo::where('estado','P')->where('fecha_entrega','<=',DB::raw('curdate()'))
            ->get();
        if(count($prestamoPendiente)>0){
            $data[]=["mensaje"=>"Hay ".count($prestamoPendiente)." Libros sin devolver","link"=>route('resumen.index')];
        }
        
        return $data;
    }
}
