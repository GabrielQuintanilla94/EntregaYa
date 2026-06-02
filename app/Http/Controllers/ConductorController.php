<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Entrega; // Importamos el modelo Entrega
use Illuminate\Support\Facades\Auth; // Importamos Auth para saber quién inició sesión

class ConductorController extends Controller
{
    public function index()
    {
        // Buscamos en la base de datos SOLO a los que tengan el rol 'conductor'
        $conductores = User::where('rol', 'conductor')->get();
        
        // Enviamos esa lista a una vista que crearemos en el siguiente paso
        return view('conductores', compact('conductores'));
    }

    // NUEVO MÉTODO PARA MOSTRAR EL MAPA
    public function miRuta()
    {
        // Buscamos las entregas del conductor logueado que no estén entregadas
        // Coincidiendo exactamente con los estados de tu migración
        $entregas = Entrega::where('conductor_id', Auth::id())
                           ->whereIn('estado', ['Pendiente', 'En camino'])
                           ->get();

        return view('mi-ruta', compact('entregas'));
    }
    // NUEVO MÉTODO PARA EL HISTORIAL
    public function historial()
    {
        // Buscamos solo las entregas del conductor logueado que ya estén con estado 'Entregado'
        $entregas = Entrega::where('conductor_id', Auth::id())
                           ->where('estado', 'Entregado')
                           ->orderBy('updated_at', 'desc') // Ordenamos de la más reciente a la más antigua
                           ->get();

        return view('mi-historial', compact('entregas'));
    }
    // NUEVO MÉTODO PARA REPORTAR INCIDENCIA
    public function reportarIncidencia()
    {
        // Traemos las entregas pendientes o en camino para que pueda asociar el problema a un paquete
        $entregas = Entrega::where('conductor_id', Auth::id())
                           ->whereIn('estado', ['Pendiente', 'En camino'])
                           ->get();

        return view('reportar-incidencia', compact('entregas'));
    }
}