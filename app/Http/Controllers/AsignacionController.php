<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrega;
use App\Models\User;
use App\Models\Vehiculo;

class AsignacionController extends Controller
{
    public function index()
    {
        // 1. Buscamos a los conductores disponibles
        $conductores = User::where('rol', 'conductor')->get();
        
        // 2. Traemos TODOS los vehículos para poder asignarles paquetes ilimitados
        // (Si tuvieras un estado 'En mantenimiento', podrías usar: where('estado', '!=', 'En mantenimiento'))
        $vehiculos = Vehiculo::all();
        
        // 3. Traemos las entregas que ya existen para mostrarlas en una tabla
        $entregas = Entrega::with(['conductor', 'vehiculo'])->latest()->get();

        return view('asignacion', compact('conductores', 'vehiculos', 'entregas'));
    }

   public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string',
            'celular_contacto' => 'required|string',
            'conductor_id' => 'required|exists:users,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);

        Entrega::create([
            'descripcion' => $request->descripcion,
            'direccion' => $request->direccion,
            'nombre_contacto' => $request->nombre_contacto,
            'celular_contacto' => $request->celular_contacto,
            'conductor_id' => $request->conductor_id,
            'vehiculo_id' => $request->vehiculo_id,
            'estado' => 'Pendiente',
        ]);

        return redirect('/asignacion')->with('success', 'Paquete asignado con éxito');
    }
}