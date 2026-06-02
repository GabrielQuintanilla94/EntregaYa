@extends('layouts.app')

@section('title', 'Mis Entregas - EntregaYa')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Entregas Pendientes</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $entregasPendientes->count() }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-green-100 text-green-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Entregas Completadas</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $entregasCompletadas }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-red-100 text-red-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Mis Incidencias</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $incidenciasCount }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Paquetes Asignados</h2>

            @forelse($entregasPendientes as $entrega)
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded mb-2 inline-block">Guía #{{ $entrega->id }}</span>
                        <h3 class="font-bold text-gray-800 text-lg">{{ $entrega->direccion }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $entrega->descripcion }}</p>
                        <span class="text-xs font-semibold text-gray-600 bg-gray-100 px-2 py-1 rounded mt-2 inline-block">Estado: {{ $entrega->estado }}</span>
                    </div>
                    <div class="text-right flex flex-col gap-2">
                        <a href="{{ url('/mis-entregas/' . $entrega->id) }}" class="bg-[#5c3d2e] hover:bg-[#4a3125] text-white px-4 py-2 rounded-lg text-sm font-medium transition text-center inline-block">
                        Ver Detalles
                         </a>
                    </div>
                </div>
            @empty
                <div class="bg-gray-50 p-8 rounded-xl text-center border-2 border-dashed border-gray-300">
                    <p class="text-gray-500">No tienes paquetes pendientes asignados para hoy.</p>
                </div>
            @endforelse

        </div>

      
@endsection