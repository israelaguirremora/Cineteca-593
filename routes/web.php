<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\filmController;

Route::get('/', function () {
    return view('inicio');
});
//Ruta que retorna el JSON con todas las peliculas
Route::get('/films/all',[filmController::class,'index']);

//Mostrar el JSON por id
Route::get('/films/{id}',[filmController::class,'show']);

//Ingresar al menu de peliculas
Route::get('/films',[filmController::class,'showFilms']);

//Ingresar al menu de administracion de peliculas
Route::get('/admin',[filmController::class,'adminFilms']);

//Ingresar al formulario para agregar película nueva
Route::get('/films/admin/add', [filmController::class, 'showAddForm']);

//Ingresar al catálogo editable
Route::get('/films/admin/edit', [filmController::class, 'editFilms']);

//Agregar peliculas nuevas
Route::post('/films/store', [filmController::class, 'store']);

//Actualizar peliculas actuales
Route::put('/films/update/{id}', [filmController::class, 'update']);

