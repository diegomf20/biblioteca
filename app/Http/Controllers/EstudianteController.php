<?php

namespace App\Http\Controllers;

use App\model\estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Logica\Mensaje;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiante= estudiante::all();
        return view('estudiante.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        try{
            /**
             * Datos del Estudiante
             */
            $estudiante= new estudiante();
            $estudiante->nombre=$request->get('nombre');
            $estudiante->apellido=$request->get('apellido');
            $estudiante->fecha_vence=$request->get('fecha_vence');
            $estudiante->telefono=$request->get('telefoono');
            $estudiante->save();
            DB::commit();
            return redirect()->route('estudiante.index')
                    ->with('mensaje', Mensaje::success('Se registró correctamente el estudiante '.$estudiante->nombre.' '.$estudiante->apellido));
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('El estudiante '.$estudiante->nombre.' '.$estudiante->apellido .' no se ha podido registrar.'.'<br>'.$error));;
        };

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            
            $estudiante= estudiante::where('id',$id)
                        ->first();
            $estudiante->nombre=$request->get('nombre');
            $estudiante->apellido=$request->get('apellido');
            $estudiante->fecha_vence=$request->get('fecha_vence');
            $estudiante->telefono=$request->get('telefoono');
            $estudiante->save();
            DB::commit();
            return redirect()->route('estudiante.index')
                    ->with('mensaje', Mensaje::success('Los datos del estudiante '.$estudiante->nombre.' '.$estudiante->apellido).' se actualizaron correctamente');
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('Los datos del estudiante '.$estudiante->nombre.' '.$estudiante->apellido .' no se ha podido actualizar.'.'<br>'.$error));;
        };

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
