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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('bloque','BloqueController');
Route::resource('estudiante','EstudianteController');
Route::resource('libro','LibroController');
Route::resource('prestamo','PrestamoController');
Route::resource('usuario','UsuarioController');
Route::resource('bloque','BloqueController');
