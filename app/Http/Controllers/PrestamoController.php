<?php

namespace App\Http\Controllers;
use App\model\libro;
use App\model\prestamo;
use App\model\categoria;

use App\Logica\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\PrestamoValidation;

class PrestamoController extends Controller
{
    /**
     * Muestra el Historial de Prestamos
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:Operador',['only' => ['index','create', 'store', 'edit', 'update']] );
        $this->middleware('roles:Administrador',['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->has('nombre')){
            $search=["nombre" =>$request->get('nombre')];
            $request->session()->flash('search-prestamo', $search);
        }else{
            if($request->session()->has('search-prestamo')){
                $request->session()->flash('search-prestamo', $request->session()->get('search-prestamo'));
                $search=$request->session()->get('search-prestamo');
            }else{
                $search=["nombre" =>""];
            }
        }
        try {
            $prestamos=prestamo::with('libro')
                ->join('estudiante','estudiante.id',"=",'prestamo.estudiante_id')
                ->where('estudiante.nombre','like','%'.$search['nombre'].'%')
                ->orWhere('estudiante.apellido','like','%'.$search['nombre'].'%')
                ->orderBy('prestamo.estado','asc')
                ->paginate(8);
            return view('prestamo.index',compact('prestamos','search'));    //code...
        } catch (\Exception $e) {
            return redirect()->route('prestamo.index');
        }
    }

    /**
     * Muestra la vista de crear un nuevo Prestamo y Muestra los Libros por Filtros
     */
    public function create(Request $request)
    {
        if($request->has('categoria')||$request->has('titulo')||$request->has('autor')){
            $search=[
                "categoria" =>$request->get('categoria'),
                "titulo"    =>$request->get('titulo'),
                "autor"     =>$request->get('autor')
            ];
            $request->session()->flash('search-prestamo-libro', $search);
        }else{
            if($request->session()->has('search-prestamo-libro')){
                $request->session()->flash('search-prestamo-libro', $request->session()->get('search-prestamo-libro'));
                $search=$request->session()->get('search-prestamo-libro');
            }else{
                $search=["categoria" =>"","titulo"=>"","autor"=>""];
            }
        }

        $categorias=categoria::all();
        $libros=libro::leftJoin('prestamo', 'prestamo.libro_id', '=', 'libro.id')
        ->select('libro.id','libro.autor','libro.titulo','libro.categoria_id','libro.unidad',DB::raw('COUNT(prestamo.id) as prestado'))
        ->where([
            ['categoria_id', 'like','%'.$search['categoria'].'%'],
            ['autor', 'like','%'.$search['autor'].'%'],
        ])->where(function ($query) use ($search) {
            return $query->where('titulo', 'like','%'.$search['titulo'].'%')
                  ->orWhere('descripcion', 'like','%'.$search['titulo'].'%');
        })->groupBy(['libro.id','libro.autor','libro.titulo','libro.categoria_id','libro.unidad'])
        ->where(function ($query) {
            return $query->where('prestamo.estado','P')
                    ->orWhere('prestamo.estado',null);
        })
        ->paginate(8);
        return view('prestamo.new',compact('categorias','libros','search'));
    }

    /**
     * Crea un nuevo Prestamo de Biblioteca
     */
    public function store(PrestamoValidation $request)
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
    public function update(PrestamoValidation $request, $id)
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
