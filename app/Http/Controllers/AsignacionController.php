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
        // 1. Validamos los datos del formulario
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'conductor_id' => 'required|exists:users,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);

        // 2. Creamos la nueva entrega
        Entrega::create([
            'descripcion' => $request->descripcion,
            'direccion' => $request->direccion,
            'conductor_id' => $request->conductor_id,
            'vehiculo_id' => $request->vehiculo_id,
            'estado' => 'Pendiente' // Por defecto empieza en pendiente
        ]);

        // NOTA: Se eliminó el bloque que cambiaba el estado del vehículo a "En ruta" 
        // para permitir asignaciones ilimitadas al mismo vehículo.

        // 3. Regresamos a la pantalla con un mensaje de éxito
        return redirect('/asignacion')->with('success', 'Paquete asignado correctamente al conductor y vehículo.');
    }
}