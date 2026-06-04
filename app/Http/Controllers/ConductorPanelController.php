<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrega;
use Illuminate\Support\Facades\Auth;

class ConductorPanelController extends Controller
{
    public function index()
    {
        // Traemos solo las entregas asignadas a este conductor que no estén terminadas
        $entregas = Entrega::with('vehiculo')
            ->where('conductor_id', Auth::id())
            ->whereIn('estado', ['Pendiente', 'En camino'])
            ->get();

        return view('mis-entregas', compact('entregas'));
    }
}