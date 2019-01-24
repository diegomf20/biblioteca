<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\libro;
use App\Model\estudiante;
use App\Model\prestamo;
use Illuminate\Support\Facades\DB;

class ResumenController extends Controller
{
    public function index(){
        $top=libro::select('libro.titulo','libro.autor',DB::raw('COUNT(prestamo.id) as prestado'))
            ->join('prestamo','prestamo.libro_id','=','libro.id')
            ->groupBy(['libro.titulo','libro.autor'])
            ->orderBy('prestado','desc')
            ->limit(3)
            ->get();
        $topLector=estudiante::select('estudiante.nombre','estudiante.apellido',DB::raw('COUNT(prestamo.id) as prestado'))
            ->join('prestamo','prestamo.estudiante_id','=','estudiante.id')
            ->groupBy(['estudiante.nombre','estudiante.apellido'])
            ->orderBy('prestado','desc')
            ->limit(3)
            ->get();
        $prestamoPendiente=Prestamo::get();
        return view('resumen.index',compact('top','topLector'));
    }
}
