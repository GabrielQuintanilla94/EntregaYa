@extends('layouts.app')

@section('title', 'Incidencias Reportadas - EntregaYa')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Alertas e Incidencias</h1>
    <p class="text-gray-500">Monitoreo de problemas reportados por los conductores en ruta.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-red-50 border-b border-red-100 text-red-800 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Conductor</th>
                    <th class="p-4 font-semibold">Tipo de Problema</th>
                    <th class="p-4 font-semibold">Detalles</th>
                    <th class="p-4 font-semibold">Fecha</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($incidencias as $incidencia)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <div class="font-bold text-gray-800">{{ $incidencia->conductor->name ?? 'Desconocido' }}</div>
                        @if($incidencia->entrega)
                            <span class="inline-block mt-1 text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded">Guía #{{ $incidencia->entrega->id }}</span>
                        @endif
                    </td>
                    <td class="p-4">
                        <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">
                            ⚠️ {{ $incidencia->tipo_incidencia }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-600 text-sm max-w-sm">
                        {{ $incidencia->detalles }}
                    </td>
                    <td class="p-4 text-gray-500 text-sm">
                        {{ $incidencia->created_at->format('d/m/Y h:i A') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p>No hay ninguna incidencia reportada. Todo marcha excelente.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection