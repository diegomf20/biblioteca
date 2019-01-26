<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\libro;
use App\model\estudiante;
use App\model\prestamo;
use Illuminate\Support\Facades\DB;

class ResumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:Administrador');
    }
    
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
        $prestamoPendiente=prestamo::where('fecha_entrega','>=','CURDATE()')
            ->where('estado','P')
            ->get();
        // dd($prestamoPendiente);
        return view('resumen.index',compact('top','topLector','prestamoPendiente'));
    }
}
