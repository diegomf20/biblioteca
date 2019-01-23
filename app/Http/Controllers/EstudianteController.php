<?php

namespace App\Http\Controllers;

use App\model\estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Logica\Mensaje;
use App\Http\Requests\EstudianteValidation;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes= estudiante::all();
        return view('estudiante.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estudiante.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudianteValidation $request)
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
            $estudiante->telefono=$request->get('telefono');
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
        DB::beginTransaction();
        try {
            $estudiante=estudiante::where('id',$id)->first();
            DB::commit();
            return view('estudiante.show',compact('estudiante'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('estudiante.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $estudiante=estudiante::where('id',$id)->first();
            DB::commit();
            return view('estudiante.edit',compact('estudiante'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('estudiante.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(EstudianteValidation $request, $id)
    {
        DB::beginTransaction();
        try{
            
            $estudiante= estudiante::where('id',$id)
                        ->first();
            $estudiante->nombre=$request->get('nombre');
            $estudiante->apellido=$request->get('apellido');
            $estudiante->fecha_vence=$request->get('fecha_vence');
            $estudiante->telefono=$request->get('telefono');
            $estudiante->save();
            DB::commit();
            return redirect()->route('estudiante.index')
                    ->with('mensaje', Mensaje::success('Los datos del estudiante '.$estudiante->nombre.' '.$estudiante->apellido.' se actualizaron correctamente'));
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

    public function buscarestudiante(Request $request){
        $term = $request->term;
        $results = array();
        
        $queries = estudiante::select('nombre','apellido', 'id')
                        ->where('nombre', 'LIKE', "%{$term}%")
                        ->orWhere('apellido', 'LIKE', "%{$term}%")
                        ->take(5)
                        ->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' =>$query->nombre.' '.$query->apellido ];
        }
        return response()->json($results);
    }
}
