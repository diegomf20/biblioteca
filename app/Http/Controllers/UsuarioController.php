<?php

namespace App\Http\Controllers;

use App\model\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
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
        DB::beginTransaction();
        try {
            $usuarios=usuario::all();
            DB::commit();
            return view('usuario.index', compact('usuarios'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('usuario.index');
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $usuario=new usuario();
            $usuario->nombre=$request->get('nombre');
            $usuario->apellido=$request->get('apellido');
            $usuario->usuario=$request->get('usuario');
            $usuario->conytrasenia=$request->get('contrasenia');
            $usuario->email=$request->get('email');
            $usuario->save();
            DB::commit();

            return redirect()->route('usuario.index')
            ->with('mensaje', Mensaje::success('Se registró correctamente el usuario '.$usuario->nombre.' '.$usuario->apellido));
        } catch (\Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('El usuario '.$usuario->nombre.' '.$usuario->apellido.' no se ha podido registrar.'.'<br>'.$error));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        DB::beginTransaction();
        try {
            $usuario=usuario::where('id',$id);
            DB::commit();
            return view('usuario.show', compact('usuario'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('usuario.index');
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::beginTransaction();
        try {
            $usuario=usuario::where('id',$id);
            DB::commit();
            return view('usuario.edit', compact('usuario'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('usuario.index');
        }   
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $usuario=usuario::where('id',$id)->first();
            $usuario->nombre=$request->get('nombre');
            $usuario->apellido=$request->get('apellido');
            $usuario->usuario=$request->get('usuario');
            $usuario->email=$request->get('email');
            $usuario->save();
            DB::commit();

            return redirect()->route('usuario.index')
            ->with('mensaje', Mensaje::success('Se actualizo correctamente el usuario '.$usuario->nombre.' '.$usuario->apellido));
        } catch (\Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            return redirect()->back()->with('mensaje', Mensaje::danger ('El usuario '.$usuario->nombre.' '.$usuario->apellido.' no se ha podido actualizar.'.'<br>'.$error));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
