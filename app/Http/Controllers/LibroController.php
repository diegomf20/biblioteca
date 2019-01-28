<?php

namespace App\Http\Controllers;

use App\model\libro;
use App\model\categoria;
use App\Logica\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\model\bloque;
use App\Http\Requests\LibroValidation;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('roles:Operador',['except' => ['create', 'store', 'edit', 'update','destroy']] );
        $this->middleware('roles:Administrador',['only' => ['create', 'store', 'edit', 'update','destroy']] );
    }
    
    public function index(Request $request)
    {
        if($request->has('categoria')||$request->has('titulo')||$request->has('autor')){
            $search=[
                "categoria" =>$request->get('categoria'),
                "titulo"    =>$request->get('titulo'),
                "autor"     =>$request->get('autor')
            ];
            $request->session()->flash('search-libro', $search);
        }else{
            if($request->session()->has('search-libro')){
                $request->session()->flash('search-libro', $request->session()->get('search-libro'));
                $search=$request->session()->get('search-libro');
            }else{
                $search=["categoria" =>"","titulo"=>"","autor"=>""];
            }
        }
        $categorias=categoria::all();
        $libros=libro::with('bloque')->where([
                    ['categoria_id', 'like','%'.$search['categoria'].'%'],
                    ['autor', 'like','%'.$search['autor'].'%'],
                ])
                ->where(function ($query) use ($search) {
                    return $query->where('titulo', 'like','%'.$search['titulo'].'%')
                        ->orWhere('descripcion', 'like','%'.$search['titulo'].'%');
                })
                ->paginate(8);
        return view('libro.index',compact('libros','categorias','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias=categoria::all();
        $bloques=bloque::all();
        return view('libro.new',compact('categorias','bloques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibroValidation $request)
    {
        DB::beginTransaction();
        try {
            $libro = new libro();
            $libro->titulo=$request->get('titulo');
            $libro->autor=$request->get('autor');
            $libro->fila=$request->get('fila');
            $libro->codigo=$request->get('codigo');
            $libro->descripcion=$request->get('descripcion');
            $libro->unidad=$request->get('unidad');
            $libro->fecha_publicacion=$request->get('fecha_publicacion');
            $libro->bloque_id=$request->get('bloque_id');
            $libro->categoria_id=$request->get('categoria_id');
            $libro->save();
            DB::commit();
            return redirect()->route('libro.index')
            ->with('mensaje', Mensaje::success('Se registró correctamente el libro '.$libro->titulo));    
        } catch (\Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd('El libro '.$libro->titulo.' no se ha podido registrar.'.'<br>'.$error);
            return redirect()->back()->with('mensaje', Mensaje::danger ('El libro '.$libro->titulo.' no se ha podido registrar.'.'<br>'.$error));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = libro::where('id',$id)->first();
        $categorias=categoria::all();
        $bloques=bloque::all();
        return view('libro.edit',compact('libro','categorias','bloques'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $libro = libro::where('id',$id)->first();
            $libro->titulo=$request->get('titulo');
            $libro->autor=$request->get('autor');
            $libro->fila=$request->get('fila');
            $libro->codigo=$request->get('codigo');
            $libro->descripcion=$request->get('descripcion');
            $libro->unidad=$request->get('unidad');
            $libro->fecha_publicacion=$request->get('fecha_publicacion');
            $libro->bloque_id=$request->get('bloque_id');
            $libro->categoria_id=$request->get('categoria_id');
            $libro->save();
            DB::commit();
            return redirect()->route('libro.index')
            ->with('mensaje', Mensaje::success('Se actualizo correctamente el libro '.$libro->titulo));    
        } catch (\Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('El libro '.$libro->titulo.' no se ha podido actualizar.'.'<br>'.$error));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
