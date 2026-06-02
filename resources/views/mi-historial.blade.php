@extends('layouts.app')

@section('title', 'Historial de Entregas - EntregaYa')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Historial de Entregas</h1>
            <p class="text-gray-500 mt-1">Aquí puedes revisar todos los paquetes que has entregado exitosamente.</p>
        </div>
        <div class="flex gap-3">
            <div class="bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm flex items-center gap-2">
                <span class="text-gray-500 text-sm">Total Completadas:</span>
                <span class="font-bold text-green-600 text-lg">{{ $entregas->count() }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-sm uppercase tracking-wider">
                        <th class="p-4 font-semibold">Guía / Paquete</th>
                        <th class="p-4 font-semibold">Dirección de Entrega</th>
                        <th class="p-4 font-semibold">Fecha y Hora</th>
                        <th class="p-4 font-semibold text-center">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    
                    @forelse($entregas as $entrega)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800">#EY-{{ str_pad($entrega->id, 4, '0', STR_PAD_LEFT) }}</span>
                                <span class="text-sm text-gray-500">{{ $entrega->descripcion }}</span>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="text-gray-700">{{ $entrega->direccion }}</span>
                        </td>
                        <td class="p-4 text-gray-600 text-sm">
                            {{ $entrega->updated_at->format('d/m/Y') }} a las {{ $entrega->updated_at->format('h:i A') }}
                        </td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Entregado
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <p>Aún no tienes entregas completadas en tu historial.</p>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection