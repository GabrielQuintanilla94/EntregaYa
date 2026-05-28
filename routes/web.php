<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\AuthController;

// =========================================================
// 1. RUTAS PÚBLICAS (Afuera de la protección)
// =========================================================
Route::get('/', function () { 
    return redirect('/login'); 
});

// Rutas para ver el formulario y procesar el inicio de sesión
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rutas para ver el formulario y procesar el registro
Route::get('/registro', [AuthController::class, 'create'])->name('registro');
Route::post('/registro', [AuthController::class, 'register']);

// =========================================================
// 2. RUTAS PROTEGIDAS (Adentro del middleware auth)
// =========================================================
Route::middleware('auth')->group(function () {
    
    // Vistas principales
    Route::get('/dashboard', function () { return view('dashboard'); });
    Route::get('/asignacion', function () { return view('asignacion'); });
    Route::get('/historial', function () { return view('historial'); });
    
    // CRUD de Vehículos
    Route::get('/flotilla', [VehiculoController::class, 'index']);
    Route::get('/flotilla/crear', [VehiculoController::class, 'create']);
    Route::post('/flotilla', [VehiculoController::class, 'store']);
    
    // Ruta para cerrar sesión (solo puedes salir si ya entraste)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});