<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrega;
use App\Models\User;
use App\Models\Vehiculo;

/**
 * Controlador encargado de gestionar la asignación de paquetes (entregas)
 * a los conductores y vehículos disponibles en el sistema.
 */
class AsignacionController extends Controller
{
    /**
     * Muestra el formulario para asignar una nueva entrega y la lista de entregas existentes.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Buscamos a los usuarios que tienen el rol de 'conductor' para llenar el selector
        $conductores = User::where('rol', 'conductor')->get();
        
        // 2. Traemos TODOS los vehículos registrados en la flotilla.
        // (Si el sistema tuviera estados como 'En mantenimiento', se podría filtrar aquí,
        // por ejemplo: Vehiculo::where('estado', '!=', 'En mantenimiento')->get())
        $vehiculos = Vehiculo::all();
        
        // 3. Traemos todas las entregas existentes, incluyendo sus relaciones (conductor y vehículo),
        // ordenadas desde la más reciente a la más antigua (latest).
        $entregas = Entrega::with(['conductor', 'vehiculo'])->latest()->get();

        // 4. Retornamos la vista de asignación y le pasamos los datos necesarios
        return view('asignacion', compact('conductores', 'vehiculos', 'entregas'));
    }

    /**
     * Valida y guarda en la base de datos una nueva asignación de entrega.
     * 
     * @param \Illuminate\Http\Request $request La solicitud HTTP con los datos del formulario.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validamos que todos los campos requeridos estén presentes y tengan el formato correcto
        $request->validate([
            'descripcion' => 'required|string',               // Descripción del paquete
            'direccion' => 'required|string',                 // Dirección de destino
            'nombre_contacto' => 'required|string',           // Nombre de quien recibe
            'celular_contacto' => 'required|string',          // Teléfono de quien recibe
            'conductor_id' => 'required|exists:users,id',     // El conductor asignado debe existir
            'vehiculo_id' => 'required|exists:vehiculos,id',  // El vehículo asignado debe existir
        ]);

        // 2. Creamos el nuevo registro de la entrega en la base de datos
        Entrega::create([
            'descripcion' => $request->descripcion,
            'direccion' => $request->direccion,
            'nombre_contacto' => $request->nombre_contacto,
            'celular_contacto' => $request->celular_contacto,
            'conductor_id' => $request->conductor_id,
            'vehiculo_id' => $request->vehiculo_id,
            'estado' => 'Pendiente', // Todas las nuevas entregas inician en estado Pendiente
        ]);

        // 3. Redirigimos de vuelta a la página de asignaciones mostrando un mensaje de éxito
        return redirect('/asignacion')->with('success', 'Paquete asignado con éxito');
    }
}
