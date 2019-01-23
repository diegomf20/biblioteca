<?php

namespace App\Http\Controllers;

use App\model\libro;
use App\model\categoria;
use App\Logica\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\model\bloque;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias=categoria::all();
        $libros=libro::where([
            ['categoria_id', 'like','%'.$request->get('categoria').'%'],
            ['titulo', 'like','%'.$request->get('titulo').'%'],
            ['autor', 'like','%'.$request->get('autor').'%'],
        ])->paginate(8);
        return view('libro.index',compact('libros','categorias'));
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
    public function store(Request $request)
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
