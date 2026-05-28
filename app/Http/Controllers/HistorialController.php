<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrega;

class HistorialController extends Controller
{
    public function index()
    {
        // Traemos solo las entregas con estado 'Entregado'
        $entregas = Entrega::with(['conductor', 'vehiculo'])
                           ->where('estado', 'Entregado')
                           ->latest()
                           ->get();

        return view('historial', compact('entregas'));
    }
}