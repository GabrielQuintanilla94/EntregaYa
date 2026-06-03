<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistorialController;

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

// Ruta general para todos los logueados
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ZONA VIP: SOLO ADMINISTRADORES
Route::middleware(['auth', 'role:admin'])->group(function () {
   // Dashboard y Historial
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/historial', [HistorialController::class, 'index']);
    // Sistema de Asignación de Rutas
    Route::get('/asignacion', [AsignacionController::class, 'index']);
    Route::post('/asignacion', [AsignacionController::class, 'store']);
   
    
    // CRUD de Vehículos
    Route::get('/flotilla', [VehiculoController::class, 'index']);
    Route::get('/flotilla/crear', [VehiculoController::class, 'create']);
    Route::post('/flotilla', [VehiculoController::class, 'store']);
    // Vista de Conductores
    Route::get('/conductores', [ConductorController::class, 'index']);
});

// ZONA VIP: SOLO CONDUCTORES
Route::middleware(['auth', 'role:conductor'])->group(function () {
    
    // Vista principal del conductor
    Route::get('/mis-entregas', [ConductorController::class, 'misEntregas'])->name('conductor.entregas');

    // NUEVA RUTA PARA "MI RUTA" (Mapa)
    Route::get('/mi-ruta', [ConductorController::class, 'miRuta'])->name('conductor.ruta');
    // NUEVA RUTA PARA EL HISTORIAL DEL CONDUCTOR
    Route::get('/mi-historial', [ConductorController::class, 'historial'])->name('conductor.historial');
    // NUEVA RUTA PARA EL FORMULARIO DE INCIDENCIAS
    Route::get('/reportar-incidencia', [ConductorController::class, 'reportarIncidencia'])->name('conductor.incidencia');
    // NUEVA RUTA: Para recibir el formulario cuando le das a "Enviar"
    Route::post('/reportar-incidencia', [ConductorController::class, 'guardarIncidencia']);
    // RUTAS PARA DETALLES Y COMPLETAR ENTREGA
    Route::get('/mis-entregas/{id}', [ConductorController::class, 'detalleEntrega'])->name('conductor.detalle');
    Route::post('/mis-entregas/{id}/completar', [ConductorController::class, 'completarEntrega'])->name('conductor.completar');
   
    // =========================================================
    // Aquí se agregarán las rutas de mapa, escáner o estados.
    // Ej: Route::post('/mis-entregas/confirmar', [EntregaController::class, 'update']);
    // =========================================================

});
// Ruta temporal para ver el diseño
Route::get('/maqueta', function () {
    return view('welcome');
});