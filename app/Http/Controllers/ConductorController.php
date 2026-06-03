<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Entrega; // Importamos el modelo Entrega
use Illuminate\Support\Facades\Auth; // Importamos Auth para saber quién inició sesión

class ConductorController extends Controller
{
    // ==========================================
    // MÉTODO DEL ADMINISTRADOR
    // ==========================================
    public function index()
    {
        // Buscamos a los usuarios que tengan el rol de conductor
        $conductores = User::where('rol', 'conductor')->get();
        return view('conductores', compact('conductores'));
    }

    // ==========================================
    // MÉTODOS DEL CONDUCTOR
    // ==========================================

    // NUEVO MÉTODO PARA "MIS ENTREGAS" (Página de Inicio)
    public function misEntregas()
    {
        $conductor_id = Auth::id();

        // 1. Traemos los paquetes pendientes o en camino
        $entregasPendientes = Entrega::where('conductor_id', $conductor_id)
                                     ->whereIn('estado', ['Pendiente', 'En camino'])
                                     ->get();

        // 2. Contamos cuántos ya entregó para la estadística
        $entregasCompletadas = Entrega::where('conductor_id', $conductor_id)
                                      ->where('estado', 'Entregado')
                                      ->count();

        // (Opcional) Si más adelante creas tabla de incidencias, aquí las cuentas
        $incidenciasCount = 0;

        return view('mis-entregas', compact('entregasPendientes', 'entregasCompletadas', 'incidenciasCount'));
    }

    // MÉTODO PARA VER LOS DETALLES DE UN PAQUETE
    public function detalleEntrega($id)
    {
        // Buscamos el paquete específico que pertenezca a este conductor
        $entrega = Entrega::where('conductor_id', Auth::id())->findOrFail($id);
        return view('detalle-entrega', compact('entrega'));
    }

    // MÉTODO PARA MARCAR LA ENTREGA COMO COMPLETADA
    public function completarEntrega($id)
    {
        $entrega = Entrega::where('conductor_id', Auth::id())->findOrFail($id);
        
        // Cambiamos el estado a Entregado y guardamos en la base de datos
        $entrega->estado = 'Entregado';
        $entrega->save();

        // Redirigimos al inicio con un mensaje de éxito
        return redirect('/mis-entregas')->with('success', '¡Paquete entregado con éxito!');
    }

    // NUEVO MÉTODO PARA MOSTRAR EL MAPA
    public function miRuta()
    {
        // Buscamos las entregas del conductor logueado que no estén entregadas
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
    // NUEVO MÉTODO PARA GUARDAR LA INCIDENCIA
    public function guardarIncidencia(Request $request)
    {
        // 1. (Opcional) Validamos que los datos vengan correctamente
        $request->validate([
            'tipo_incidencia' => 'required|string',
            'detalles' => 'required|string',
        ]);

        // 2. Aquí iría el código para guardar en la base de datos.
        // Ej: Incidencia::create([...]); 
        // Como aún no tenemos esa tabla, pasaremos directo al paso 3.

        // 3. Redirigimos a la pantalla principal con un mensaje de éxito
        return redirect('/mis-entregas')->with('success', 'La incidencia ha sido reportada correctamente a la central.');
    }
}