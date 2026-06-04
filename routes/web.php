<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ConductorPanelController;

// =========================================================
// 1. RUTAS PÚBLICAS (Accesibles sin autenticación)
// =========================================================

// Redirigir la raíz al inicio de sesión
Route::get('/', function () { 
    return redirect('/login'); 
});

// Rutas de Autenticación - Inicio de sesión
Route::get('/login', [AuthController::class, 'index'])->name('login'); // Muestra el formulario de login
Route::post('/login', [AuthController::class, 'login']);               // Procesa las credenciales de login

// Rutas de Autenticación - Registro
Route::get('/registro', [AuthController::class, 'create'])->name('registro'); // Muestra el formulario de registro
Route::post('/registro', [AuthController::class, 'register']);                // Procesa y crea el nuevo usuario

// =========================================================
// 2. RUTAS PROTEGIDAS (Requieren iniciar sesión)
// =========================================================

// Ruta para cerrar sesión (Disponible para cualquier usuario logueado)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================================================
// ZONA DE ADMINISTRADORES
// =========================================================
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Panel principal del administrador y reporte general de historial
    Route::get('/dashboard', [DashboardController::class, 'index']); // Vista principal con estadísticas
    Route::get('/historial', [HistorialController::class, 'index']); // Historial de todas las entregas

    // Gestión de Incidencias
    Route::get('/admin/incidencias', [DashboardController::class, 'incidencias']); // Ver incidencias reportadas por conductores

    // Asignación de rutas y entregas a conductores
    Route::get('/asignacion', [AsignacionController::class, 'index']); // Formulario para asignar entregas
    Route::post('/asignacion', [AsignacionController::class, 'store']); // Guarda la nueva asignación

    // Gestión de Flotilla (Vehículos)
    Route::get('/flotilla', [VehiculoController::class, 'index']);       // Lista de vehículos
    Route::get('/flotilla/crear', [VehiculoController::class, 'create']); // Formulario para registrar vehículo
    Route::post('/flotilla', [VehiculoController::class, 'store']);      // Guarda el nuevo vehículo

    // Directorio de Conductores
    Route::get('/conductores', [ConductorController::class, 'index']); // Lista de conductores registrados
});


// =========================================================
// ZONA DE CONDUCTORES
// =========================================================
Route::middleware(['auth', 'role:conductor'])->group(function () {
    
    // Gestión de entregas asignadas
    Route::get('/mis-entregas', [ConductorController::class, 'misEntregas'])->name('conductor.entregas'); // Lista de entregas pendientes
    Route::get('/mis-entregas/{id}', [ConductorController::class, 'detalleEntrega'])->name('conductor.detalle'); // Ver detalles de una entrega específica
    Route::post('/mis-entregas/{id}/completar', [ConductorController::class, 'completarEntrega'])->name('conductor.completar'); // Marcar entrega como completada

    // Visualización de ruta en mapa
    Route::get('/mi-ruta', [ConductorController::class, 'miRuta'])->name('conductor.ruta'); // Muestra el mapa con la ruta asignada
    
    // Historial personal del conductor
    Route::get('/mi-historial', [ConductorController::class, 'historial'])->name('conductor.historial'); // Entregas completadas por el conductor
    
    // Reporte de problemas en la ruta
    Route::get('/reportar-incidencia', [ConductorController::class, 'reportarIncidencia'])->name('conductor.incidencia'); // Formulario para reportar problemas
    Route::post('/reportar-incidencia', [ConductorController::class, 'guardarIncidencia']); // Guarda el reporte de incidencia
});


// =========================================================
// RUTAS DE DESARROLLO/PRUEBAS
// =========================================================

// Ruta temporal para visualizar la maqueta o diseño inicial
Route::get('/maqueta', function () {
    return view('welcome');
});
