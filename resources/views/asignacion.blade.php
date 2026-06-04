@extends('layouts.app')

@section('title', 'Asignación de Rutas - EntregaYa')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Asignación de Rutas</h1>
    <p class="text-gray-500 mt-1">Asigna paquetes a los conductores y define el vehículo a utilizar.</p>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center gap-2 shadow-sm">
        ✅ {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-sm border border-gray-200 h-fit">
        <h3 class="font-bold text-gray-800 text-lg mb-5 flex items-center gap-2">📦 Nueva Asignación</h3>
        
        <form action="/asignacion" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Descripción del Paquete</label>
                <input type="text" name="descripcion" required placeholder="Ej. 2 Cajas de Electrónicos" class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-700 focus:ring-[#5c3d2e] focus:border-[#5c3d2e] bg-gray-50">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Dirección de Entrega</label>
                <input type="text" name="direccion" required placeholder="Ej. Calle Principal #123, Ciudad" class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-700 focus:ring-[#5c3d2e] focus:border-[#5c3d2e] bg-gray-50">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nombre de Contacto</label>
                    <input type="text" name="nombre_contacto" required placeholder="Ej. Juan Pérez" class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-700 focus:ring-[#5c3d2e] focus:border-[#5c3d2e] bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Celular</label>
                    <input type="text" name="celular_contacto" required placeholder="Ej. 7000-0000" class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-700 focus:ring-[#5c3d2e] focus:border-[#5c3d2e] bg-gray-50">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Conductor</label>
                <select name="conductor_id" required class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-700 focus:ring-[#5c3d2e] focus:border-[#5c3d2e] bg-gray-50">
                    <option value="" disabled selected>-- Elige un conductor --</option>
                    @foreach($conductores as $conductor)
                        <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Vehículo (Disponibles)</label>
                <select name="vehiculo_id" required class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-700 focus:ring-[#5c3d2e] focus:border-[#5c3d2e] bg-gray-50">
                    <option value="" disabled selected>-- Elige un vehículo --</option>
                    @foreach($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->modelo }} (Placa: {{ $vehiculo->placa }})</option>
                    @endforeach
                </select>
                @if($vehiculos->isEmpty())
                    <p class="text-xs text-red-600 mt-1 font-medium">⚠️ No hay vehículos disponibles. Registra uno o espera.</p>
                @endif
            </div>

            <button type="submit" class="w-full py-3 rounded-lg font-bold text-white transition mt-4 {{ $vehiculos->isEmpty() ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#5c3d2e] hover:bg-[#4a3125] shadow-md' }}" @if($vehiculos->isEmpty()) disabled @endif>
                Asignar Paquete
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-fit">
        <div class="p-5 border-b border-gray-200 bg-gray-50">
            <h3 class="font-bold text-gray-800 text-lg">🚚 Entregas Recientes</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="p-4 font-semibold">Paquete / Destino</th>
                        <th class="p-4 font-semibold">Conductor</th>
                        <th class="p-4 font-semibold">Vehículo</th>
                        <th class="p-4 font-semibold text-center">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($entregas as $entrega)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4">
                            <div class="font-bold text-gray-800">{{ $entrega->descripcion }}</div>
                            <div class="text-xs text-gray-500 mt-1">📍 {{ $entrega->direccion }}</div>
                        </td>
                        <td class="p-4 text-sm text-gray-700">{{ $entrega->conductor->name }}</td>
                        <td class="p-4 text-sm text-gray-700 font-medium">{{ $entrega->vehiculo->placa }}</td>
                        <td class="p-4 text-center">
                            @if($entrega->estado == 'Pendiente')
                                <span class="bg-yellow-100 text-yellow-800 px-2.5 py-1 rounded text-xs font-bold border border-yellow-200">Pendiente</span>
                            @elseif($entrega->estado == 'En camino')
                                <span class="bg-blue-100 text-blue-800 px-2.5 py-1 rounded text-xs font-bold border border-blue-200">En Camino</span>
                            @elseif($entrega->estado == 'Entregado')
                                <span class="bg-green-100 text-green-800 px-2.5 py-1 rounded text-xs font-bold border border-green-200">Entregado</span>
                            @elseif($entrega->estado == 'Reportado')
                                <span class="bg-red-100 text-red-800 px-2.5 py-1 rounded text-xs font-bold border border-red-200">Reportado</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500 bg-gray-50">No hay entregas registradas aún.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection