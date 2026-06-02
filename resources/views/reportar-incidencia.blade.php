@extends('layouts.app')

@section('title', 'Reportar Incidencia - EntregaYa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <div class="bg-red-100 p-3 rounded-full text-red-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Reportar Incidencia</h1>
            <p class="text-gray-500 mt-1">Registra cualquier problema en tu ruta para notificar a la base central.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form action="#" method="POST" class="p-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Problema <span class="text-red-500">*</span></label>
                    <select name="tipo_incidencia" class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#5c3d2e] focus:border-[#5c3d2e] p-3 transition" required>
                        <option value="" disabled selected>Selecciona una opción...</option>
                        <option value="trafico">Tráfico pesado / Bloqueo en vía</option>
                        <option value="vehiculo">Falla mecánica en vehículo</option>
                        <option value="cliente_ausente">Cliente no responde / Ausente</option>
                        <option value="direccion">Dirección incorrecta o confusa</option>
                        <option value="paquete_dano">Paquete dañado</option>
                        <option value="otro">Otro inconveniente</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Asociar a un Paquete (Opcional)</label>
                    <select name="entrega_id" class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#5c3d2e] focus:border-[#5c3d2e] p-3 transition">
                        <option value="general">Ninguno (Problema general de ruta)</option>
                        @foreach($entregas as $entrega)
                            <option value="{{ $entrega->id }}">
                                Guía #{{ $entrega->id }} - {{ $entrega->direccion }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Detalles de la Incidencia <span class="text-red-500">*</span></label>
                <textarea name="detalles" rows="4" class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#5c3d2e] focus:border-[#5c3d2e] p-3 transition" placeholder="Describe brevemente el problema (ej. Llanta pinchada cerca de Blvd. de los Héroes, grúa en camino...)" required></textarea>
            </div>

            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ url('/mis-entregas') }}" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 transition">
                    Cancelar
                </a>
                <button type="button" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    Enviar Reporte
                </button>
            </div>
        </form>
    </div>
</div>
@endsection