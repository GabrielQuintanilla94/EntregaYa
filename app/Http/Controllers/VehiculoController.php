<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    public function index()
    {
        // Obtiene todos los vehículos de MySQL y los envía a la vista
        $vehiculos = Vehiculo::all();
        return view('flotilla', compact('vehiculos'));
    }

    public function create()
    {
        return view('crear_vehiculo');
    }

    public function store(Request $request)
    {
        // 1. Validar que no vengan campos vacíos o placas duplicadas
        $request->validate([
            'placa' => 'required|unique:vehiculos|max:15',
            'modelo' => 'required|max:100',
            'capacidad' => 'required|max:50',
            'estado' => 'required|in:Disponible,En ruta,Mantenimiento'
        ]);

        // 2. Guardar en la base de datos usando Eloquent
        Vehiculo::create([
            'placa' => $request->placa,
            'modelo' => $request->modelo,
            'capacidad' => $request->capacidad,
            'estado' => $request->estado
        ]);

        // 3. Redirigir a la tabla con un mensaje de éxito
        return redirect('/flotilla')->with('success', 'Vehículo registrado exitosamente.');
    }
}