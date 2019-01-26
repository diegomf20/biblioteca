<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Rol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) 
            return view('login');

        $user = Auth::user();

        if($user->isAdmin())
            return $next($request);
            
        foreach($roles as $rol) {
            if($request->ajax()){
                if($user->hasRol($rol)){
                    return $next($request);
                }
                return response()->json(array('success' =>'false', 'mensaje'=>'Consulte con tu administrador'));
            }
            if($user->hasRol($rol)){
                return $next($request);
            }
           
        }  
        return redirect()->back()->with('acceso', 'Consulte con tu administrador');
    }
}
