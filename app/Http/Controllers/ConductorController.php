<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Importamos el modelo de usuarios

class ConductorController extends Controller
{
    public function index()
    {
        // Buscamos en la base de datos SOLO a los que tengan el rol 'conductor'
        $conductores = User::where('rol', 'conductor')->get();
        
        // Enviamos esa lista a una vista que crearemos en el siguiente paso
        return view('conductores', compact('conductores'));
    }
}