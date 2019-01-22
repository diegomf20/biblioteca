<?php

namespace App\Http\Controllers;
use App\model\libro;
use App\model\prestamo;
use App\model\categoria;

use App\Logica\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrestamoController extends Controller
{
    /**
     * Muestra el Historial de Prestamos
     */
    public function index()
    {
        try {
            $prestamos=prestamo::with('libro')->get();
            return view('prestamo.index',compact('prestamos'));    //code...
        } catch (\Exception $e) {
            return redirect()->route('prestamo.index');
        }
    }

    /**
     * Muestra la vista de crear un nuevo Prestamo y Muestra los Libros por Filtros
     */
    public function create(Request $request)
    {
        $categorias=categoria::all();
        $libros=libro::leftJoin('prestamo', 'prestamo.libro_id', '=', 'libro.id')
        ->select('libro.id','libro.autor','libro.titulo','libro.categoria_id','libro.unidad',DB::raw('COUNT(prestamo.id) as prestado'))
        ->where([
            ['categoria_id', 'like','%'.$request->get('categoria').'%'],
            ['titulo', 'like','%'.$request->get('titulo').'%'],
            ['autor', 'like','%'.$request->get('autor').'%'],
        ])
        ->groupBy(['libro.id','libro.autor','libro.titulo','libro.categoria_id','libro.unidad'])
        ->where('prestamo.estado','P')
        ->paginate(2);
        return view('prestamo.new',compact('categorias','libros'));
    }

    /**
     * Crea un nuevo Prestamo de Biblioteca
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $prestamo= new prestamo();
            $prestamo->fecha_prestamo=$request->get('fecha_prestamo');
            $prestamo->fecha_entrega=$request->get('fecha_entrega');
            $prestamo->estado='P';
            $prestamo->estudiante_id=$request->get('estudiante_id');
            $prestamo->usuario_id=1;
            $prestamo->libro_id=$request->get('libro_id');
            $prestamo->save();
            DB::commit();
            return redirect()->route('prestamo.index')
                    ->with('mensaje', Mensaje::success('Se registró correctamente el prestamo'));
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('El préstamo no se ha podido registrar.'.'<br>'.$error));;
        };
        
    }

    /**
     * Actualiza el estado del Prestamo y su fecha de entrega
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $prestamo=prestamo::where('id',$id)->first();
            $prestamo->fecha_entrega=Carbon::now();;
            $prestamo->estado='E';
            $prestamo->save();
            DB::commit(); 
            return redirect()->route('prestamo.index')
                    ->with('mensaje', Mensaje::success('El estudiante devolvio el libro'));
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('Ocurrio un error'.'<br>'.$error));;
        };
    }
}
