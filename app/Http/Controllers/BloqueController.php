<?php

namespace App\Http\Controllers;

use App\model\bloque;
use App\Logica\Mensaje;
use Illuminate\Http\Request;
use App\Http\Requests\BloqueValidation;
use Illuminate\Support\Facades\DB;

class BloqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:Administrador');
    }

    public function index()
    {
        $bloques=bloque::all();
        return view('bloque.index',compact('bloques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bloque.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloqueValidation $request)
    {
        $this->validate($request, [
            'unidad'    =>  'unique:bloque,nombre_bloque',
        ]); 

        DB::beginTransaction();
        try{
            $bloque=new bloque();
            $bloque->nombre_bloque=strtoupper($request->get('nombre'));
            $bloque->filas=$request->get('filas');
            $bloque->save();
            DB::commit();
            return redirect()->route('bloque.index')
                ->with('mensaje', Mensaje::success('Se registró correctamente el bloque '.$bloque->nombre_bloque));
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()
                ->with('mensaje', Mensaje::danger('Error: '.$e->getMessage()));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\ $bloque
     * @return \Illuminate\Http\Response
     */
    public function edit($bloque)
    {
        DB::beginTransaction();
        try{
            $bloque=bloque::where('id',$bloque)->first();
            DB::commit();
            return view('bloque.edit',compact('bloque'));
        }catch(\Exception $e){
            DB::rolback();
            return redirect()->route('bloque.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\ $bloque
     * @return \Illuminate\Http\Response
     */
    public function update(BloqueValidation $request, $bloque)
    {
        $bloque=bloque::where('id',$bloque)->first();
       
        if($bloque->nombre_bloque!==strtoupper($request->get('nombre'))){
            $this->validate($request, [
                'nombre'    =>  'unique:bloque,nombre_bloque',
            ]); 
        }
        DB::beginTransaction();
        try{
            $bloque->nombre_bloque=strtoupper($request->get('nombre'));
            $bloque->filas=$request->get('filas');
            $bloque->save();
            DB::commit();
            return redirect()->route('bloque.index')
                ->with('mensaje', Mensaje::success('Se actualizo el bloque '.$bloque->nombre_bloque));    
        }catch(\Exception $e){
            DB::rolback();
            return redirect()->back()
                ->with('mensaje', Mensaje::danger('Error: '.$e->getMessage()));
        }
    }
}
