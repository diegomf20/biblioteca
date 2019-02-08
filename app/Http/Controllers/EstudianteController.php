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
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('roles:Administrador');
        $this->middleware('roles:Administrador',['except' => ['buscarestudiante']] );
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
        $nombre=explode(" ",$search['nombre']);
        $estudiantes= estudiante::where(DB::raw('concat(estudiante.nombre,estudiante.apellido)'),'like','%'.$nombre[0].'%');
        for ($i=0; $i < count($nombre)-1; $i++) { 
            $estudiantes=$estudiantes->orWhere(DB::raw('concat(estudiante.nombre,estudiante.apellido)'),'like','%'.$nombre[$i+1].'%');
        }
        $estudiantes=$estudiantes->paginate(6);
        return view('estudiante.index', compact('estudiantes','search'));
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
        $nombres=explode(" ", $term);
        $results = array();
        /* $queries = estudiante::select('nombre','apellido', 'id')
                        ->where([
                            ['nombre', 'like','%'.$nombres[0].'%'],
                            ['apellido', 'like','%'.$nombres[1].'%'],
                        ])
                        ->get(); */
        $queries = estudiante::selectRaw("nombre,apellido, id")
        ->whereRaw("MATCH(nombre,apellido)AGAINST('*".$term."''*' IN BOOLEAN MODE)")
        ->get();
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' =>$query->nombre.' '.$query->apellido ];
        }
        return response()->json($results);
    }
}

