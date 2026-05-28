<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\Entrega;

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
}