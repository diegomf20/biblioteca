<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function index(){
        return view('login');
    }
    public function postLogin(Request $request)
    {
        
        $credentials=$this->validate($request, [
            'email' => 'required', 
            'password' => 'required',
        ]);
       
        if(Auth::attempt($credentials)){
                return redirect()->route('home');
        }

        return back()
                ->withInput(request(['email']))
                ->withErrors(['email'=>trans('auth.failed')]);
    }

    public function cerrar_session(Request $request){
        session()->forget('user');
        return redirect('/home');   
    }

    public function redirectPath()
    {
        if(Auth::check()){
            return '/home';
        }

        return '/';
        
    }

}
