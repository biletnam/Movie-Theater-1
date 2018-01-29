<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
/*Route::get('prueba',function(){
  return "hola";
});*/
/*Route::get('nombre/{nombre?}',function($nombre=""){
   return "Mi nombre es: ".$nombre;
});*/
//Route::get('controlador','PruebaC@index');

//Route::get('name/{nombre}','PruebaC@nombre');
//Route::resource('movie','MovieController');
Route::get('/','FrontController@index');
Route::get('contacto','FrontController@contacto');
Route::get('reviews','FrontController@reviews');
Route::get('admin','FrontController@admin');
Route::resource('usuario','UsuarioController');
Route::resource('log','LogController');
Route::get('logout','LogController@logout');
Route::resource('genero','GenderController');
Route::resource('pelicula','MovieController');
Route::resource('mail','MailController');