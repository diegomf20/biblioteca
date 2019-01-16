<?php

namespace App\Http\Controllers;

use App\model\prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::beginTransaction();
        try {
            $prestamos=prestamo::all();
            DB::commit();
            return view('prestamo.index',compact('prestamos'));    //code...
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('prestamo.index');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prestamo.new');
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

            $prestamo= new prestamo();
            $prestamo->fecha_prestamo=$request->get('fecha_prestamo');
            $prestamo->fecha_entrega=$request->get('fecha_entrega');
            $prestamo->estado='P';
            $prestamo->estudiante_id=$request->get('estudiante_id');
            $prestamo->usuario_id=$request->get('usuario_id');
            $prestamo->libro_id=$request->get('libro_id');
            $prestamo->save();
            DB::commit();
            return redirect()->route('estudiante.index')
                    ->with('mensaje', Mensaje::success('Se registró correctamente el prestamo'));
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('El préstamo no se ha podido registrar.'.'<br>'.$error));;
        };
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        DB::beginTransaction();
        try {
            $prestamo=prestamo::where('id',$id);
            DB::commit();
            return view('prestamo.show',compact('prestamo'));  
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $prestamo=prestamo::where('id',$id);
            DB::commit();
            return view('prestamo.edit',compact('prestamo'));  
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $prestamo=prestamo::where('id',$id)->first();
            $prestamo->fecha_entrega=$request->get('fecha_entrega');
            $prestamo->estado='E';
            $prestamo->save();
            DB::commit(); 
            return redirect()->route('estudiante.index')
                    ->with('mensaje', Mensaje::success('El estudiante devolvio el libro'));
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('Ocurrio un error'.'<br>'.$error));;
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function buscar(Resquest $request)
    {
        $query=$request->get('buscar');
    }
}
