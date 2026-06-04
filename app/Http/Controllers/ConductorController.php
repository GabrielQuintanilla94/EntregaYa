<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Entrega; // Importamos el modelo Entrega para gestionar los paquetes
use Illuminate\Support\Facades\Auth; // Importamos Auth para identificar al usuario con sesión iniciada
use App\Models\Incidencia; // Importamos el modelo Incidencia para el reporte de problemas

/**
 * Controlador encargado de gestionar las operaciones relacionadas con los conductores,
 * tanto desde la perspectiva del administrador (ver conductores) como desde la
 * perspectiva del propio conductor (ver rutas, entregas, historial y reportes).
 */
class ConductorController extends Controller
{
    // ==========================================
    // MÉTODO DEL ADMINISTRADOR
    // ==========================================
    
    /**
     * Muestra la lista de conductores registrados en el sistema.
     * Nota: Actualmente este método tiene código inalcanzable después del primer return.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Buscamos a todos los usuarios cuyo rol sea 'conductor' en la base de datos
        $conductores = User::where('rol', 'conductor')->get();
        
        // Retornamos la vista 'conductores' pasando la lista obtenida
        return view('conductores', compact('conductores'));
        
       
        
        // 1. Contamos las entregas del conductor logueado que tengan estado 'Reportado'
        $totalIncidencias = Entrega::where('conductor_id', Auth::id())
                                   ->where('estado', 'Reportado')
                                   ->count();

        // 2. Pasamos la variable a la vista 
        return view('dashboard', compact('totalIncidencias'));
    }

    // ==========================================
    // MÉTODOS DEL CONDUCTOR
    // ==========================================

    /**
     * Muestra el panel principal del conductor con sus entregas pendientes y estadísticas.
     * (Página de inicio del conductor)
     * 
     * @return \Illuminate\View\View
     */
    public function misEntregas()
    {
        // Obtenemos el ID del conductor que tiene la sesión iniciada
        $conductor_id = Auth::id();

        // 1. Obtenemos los paquetes que están pendientes o en camino, e incluimos los datos del vehículo
        $entregas = Entrega::with('vehiculo')
                           ->where('conductor_id', $conductor_id)
                           ->whereIn('estado', ['Pendiente', 'En camino'])
                           ->get();

        // 2. Contamos cuántos paquetes ya entregó para mostrarlo en las estadísticas de su panel
        $entregasCompletadas = Entrega::where('conductor_id', $conductor_id)
                                      ->where('estado', 'Entregado')
                                      ->count();

        // 3. Contamos las incidencias reales que ha reportado este conductor
        $incidenciasCount = Incidencia::where('conductor_id', $conductor_id)->count();

        // Retornamos la vista principal del conductor con los datos necesarios
        return view('mis-entregas', compact('entregas', 'entregasCompletadas', 'incidenciasCount'));
    }

    /**
     * Muestra los detalles de un paquete específico asignado al conductor.
     * 
     * @param int $id El ID de la entrega a consultar.
     * @return \Illuminate\View\View
     */
    public function detalleEntrega($id)
    {
        // Buscamos el paquete específico asegurándonos de que pertenezca a este conductor.
        // findOrFail lanzará un error 404 si la entrega no existe o no es de él.
        $entrega = Entrega::where('conductor_id', Auth::id())->findOrFail($id);
        
        return view('detalle-entrega', compact('entrega'));
    }

    /**
     * Procesa la acción de marcar una entrega como completada.
     * 
     * @param int $id El ID de la entrega a completar.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completarEntrega($id)
    {
        // Verificamos que la entrega exista y pertenezca al conductor actual
        $entrega = Entrega::where('conductor_id', Auth::id())->findOrFail($id);
        
        // Cambiamos el estado de la entrega a 'Entregado' y la guardamos en la base de datos
        $entrega->estado = 'Entregado';
        $entrega->save();

        // Redirigimos al inicio de sus entregas mostrando un mensaje de éxito
        return redirect('/mis-entregas')->with('success', '¡Paquete entregado con éxito!');
    }

    /**
     * Muestra una vista con un mapa de las rutas o destinos pendientes del conductor.
     * 
     * @return \Illuminate\View\View
     */
    public function miRuta()
    {
        // Buscamos las entregas del conductor logueado que aún no estén entregadas
        // Solo traemos las que están en estado 'Pendiente' o 'En camino'
        $entregas = Entrega::where('conductor_id', Auth::id())
                           ->whereIn('estado', ['Pendiente', 'En camino'])
                           ->get();

        // Retornamos la vista del mapa pasándole la lista de entregas activas
        return view('mi-ruta', compact('entregas'));
    }

    /**
     * Muestra el historial de todas las entregas que ya han sido completadas por el conductor.
     * 
     * @return \Illuminate\View\View
     */
    public function historial()
    {
        // Buscamos solo las entregas del conductor logueado que tengan estado 'Entregado'
        $entregas = Entrega::where('conductor_id', Auth::id())
                           ->where('estado', 'Entregado')
                           ->orderBy('updated_at', 'desc') // Las ordenamos de la más reciente a la más antigua
                           ->get();

        // Retornamos la vista del historial
        return view('mi-historial', compact('entregas'));
    }

    /**
     * Muestra el formulario para que el conductor reporte un problema o incidencia en la ruta.
     * 
     * @return \Illuminate\View\View
     */
    public function reportarIncidencia()
    {
        // Traemos las entregas activas del conductor para que pueda asociar el problema a un paquete específico si lo desea
        $entregas = Entrega::where('conductor_id', Auth::id())
                           ->whereIn('estado', ['Pendiente', 'En camino'])
                           ->get();

        // Retornamos la vista del formulario de reporte
        return view('reportar-incidencia', compact('entregas'));
    }

    /**
     * Valida y guarda en la base de datos una nueva incidencia reportada por el conductor.
     * 
     * @param \Illuminate\Http\Request $request La solicitud HTTP con los datos del formulario.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guardarIncidencia(Request $request)
    {
        // 1. Validamos que la información recibida cumpla con las reglas requeridas
        $request->validate([
            'tipo_incidencia' => 'required|string',
            'detalles' => 'required|string',
            'entrega_id' => 'nullable|exists:entregas,id' // El ID de entrega es opcional, pero si viene, debe existir
        ]);

        // 2. Creamos y guardamos el registro de la incidencia en la base de datos
        Incidencia::create([
            'conductor_id' => Auth::id(),                 // Identificador del conductor que reporta
            'entrega_id' => $request->entrega_id,         // Entrega afectada (puede ser null)
            'tipo_incidencia' => $request->tipo_incidencia, // Categoría del problema
            'detalles' => $request->detalles              // Explicación textual del problema
        ]);

        // 3. Redirigimos al panel principal con un mensaje de éxito para el usuario
        return redirect('/mis-entregas')->with('success', '⚠️ Tu incidencia ha sido reportada a la central.');
    }
}
