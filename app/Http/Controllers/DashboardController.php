<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\Entrega;
use App\Models\Incidencia;

class DashboardController extends Controller
{
    public function index()
    {
        // Contamos cuántos datos tenemos de cada cosa
        $totalConductores = User::where('rol', 'conductor')->count();
        $vehiculosDisponibles = Vehiculo::where('estado', 'Disponible')->count();
        $entregasActivas = Entrega::whereIn('estado', ['Pendiente', 'En camino'])->count();
        $entregasCompletadas = Entrega::where('estado', 'Entregado')->count();

        return view('dashboard', compact('totalConductores', 'vehiculosDisponibles', 'entregasActivas', 'entregasCompletadas'));
    }


    public function incidencias()
    {
        // Traemos todas las incidencias de la más nueva a la más vieja
        $incidencias = Incidencia::with(['conductor', 'entrega'])->latest()->get();
        return view('admin-incidencias', compact('incidencias'));
    }
}