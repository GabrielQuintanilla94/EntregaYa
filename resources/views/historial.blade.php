@extends('layouts.app')

@section('title', 'Historial - EntregaYa')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Historial de Entregas</h1>
    <p class="text-gray-500 mt-1">Registro de todos los paquetes que ya fueron entregados exitosamente.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Paquete / Destino</th>
                    <th class="p-4 font-semibold">Entregado Por</th>
                    <th class="p-4 font-semibold">Vehículo Usado</th>
                    <th class="p-4 font-semibold text-right">Fecha de Entrega</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($entregas as $entrega)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <div class="font-bold text-gray-800">{{ $entrega->descripcion }}</div>
                        <div class="text-sm text-gray-500 mt-1">📍 {{ $entrega->direccion }}</div>
                    </td>
                    <td class="p-4 text-gray-700">{{ $entrega->conductor->name }}</td>
                    <td class="p-4 text-gray-700 font-medium">{{ $entrega->vehiculo->placa }}</td>
                    <td class="p-4 text-green-600 font-bold text-sm text-right">
                        ✅ {{ $entrega->updated_at->format('d/m/Y h:i A') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500 bg-gray-50">Aún no hay registros de entregas completadas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection