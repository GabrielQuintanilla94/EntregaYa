@extends('layouts.app')

@section('title', 'Flotilla - EntregaYa')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Flotilla de Vehículos</h1>
        <p class="text-gray-500 mt-1">Control, disponibilidad y datos de cada unidad de reparto.</p>
    </div>
    <a href="/flotilla/crear" class="bg-[#5c3d2e] hover:bg-[#4a3125] text-white px-5 py-2.5 rounded-lg text-sm font-bold transition shadow-sm inline-flex items-center gap-2">
        + Registrar Vehículo
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Placa</th>
                    <th class="p-4 font-semibold">Modelo / Vehículo</th>
                    <th class="p-4 font-semibold">Cap. Carga</th>
                    <th class="p-4 font-semibold">Estado</th>
                    <th class="p-4 font-semibold text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($vehiculos as $vehiculo)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-bold text-gray-800">{{ $vehiculo->placa }}</td>
                    <td class="p-4 text-gray-700">{{ $vehiculo->modelo }}</td>
                    <td class="p-4 text-gray-600">{{ $vehiculo->capacidad }}</td>
                    <td class="p-4">
                        @if($vehiculo->estado == 'Disponible')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Disponible</span>
                        @elseif($vehiculo->estado == 'En ruta')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">En ruta</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Mantenimiento</span>
                        @endif
                    </td>
                    <td class="p-4 text-right space-x-3">
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">Editar</a>
                        <a href="#" class="text-red-600 hover:text-red-800 font-medium text-sm transition">Eliminar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500 bg-gray-50">No hay vehículos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection