<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','LoginController@index')->name('login');
Route::post('/postlogin','LoginController@postlogin')->name('postlogin');
Route::post('cerrar/', 'LoginController@cerrar_session')->name('cerrar');
Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::resource('bloque','BloqueController');
Route::resource('estudiante','EstudianteController');
Route::resource('libro','LibroController');
Route::resource('prestamo','PrestamoController')->only(['index', 'create','store','update']);
Route::resource('usuario','UsuarioController');
Route::resource('bloque','BloqueController');
Route::get('buscar','EstudianteController@buscarestudiante')->name('estudiante.buscar');

Route::get('resumen','ResumenController@index')->name('resumen.index');

Route::get('alerta','AlertaController@alerta')->name('alerta');