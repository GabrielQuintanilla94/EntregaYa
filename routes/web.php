<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/flotilla', [VehiculoController::class, 'index']);
Route::get('/flotilla/crear', [VehiculoController::class, 'create']); 
Route::post('/flotilla', [VehiculoController::class, 'store']); 
Route::get('/dashboard', function () { return view('dashboard'); });
Route::get('/asignacion', function () { return view('asignacion'); });
Route::get('/historial', function () { return view('historial'); });