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
Route::get('/bloque',function(){
    return view('bloque.index');
})->name('bloque.index');

Route::get('/bloque/new',function(){
    return "hola";
})->name('bloque.new');

Route::get('/bloque/edit',function(){
    return "hola";
})->name('bloque.edit');