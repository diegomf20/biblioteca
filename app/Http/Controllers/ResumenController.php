<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\libro;
use App\model\estudiante;
use App\model\prestamo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:Administrador');
    }
    
    public function index(){
        setlocale(LC_ALL, 'es_ES');
        $mes_actual=Carbon::now()->formatLocalized('%B');
        
        // $mes = $fecha;
        $top=libro::select('libro.titulo','libro.autor',DB::raw('COUNT(prestamo.id) as prestado'))
            ->join('prestamo','prestamo.libro_id','=','libro.id')
            ->groupBy(['libro.titulo','libro.autor'])
            ->orderBy('prestado','desc')
            ->where(DB::raw('month(prestamo.fecha_prestamo)'),DB::raw('month(curdate())'))
            ->limit(3)
            ->get();
        $topLector=estudiante::select('estudiante.nombre','estudiante.apellido',DB::raw('COUNT(prestamo.id) as prestado'))
            ->join('prestamo','prestamo.estudiante_id','=','estudiante.id')
            ->groupBy(['estudiante.nombre','estudiante.apellido'])
            ->orderBy('prestado','desc')
            ->where(DB::raw('month(prestamo.fecha_prestamo)'),DB::raw('month(curdate())'))            
            ->limit(3)
            ->get();
        $prestamoPendiente=prestamo::where('estado','P')->where('fecha_entrega','<=',DB::raw('curdate()'))
            ->get();
        return view('resumen.index',compact('top','topLector','prestamoPendiente','mes_actual'));
    }
    
}
