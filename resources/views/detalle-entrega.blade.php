@extends('layouts.app')

@section('title', 'Detalles - EntregaYa')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ url('/mis-entregas') }}" class="text-blue-600 hover:text-blue-800 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detalles del Paquete</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        
        <div class="p-6 space-y-4">
            <div class="border-b border-gray-100 pb-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Guía / ID</p>
                <p class="text-lg font-bold text-gray-900">#{{ $entrega->id }}</p>
            </div>

            <div class="border-b border-gray-100 pb-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Descripción</p>
                <p class="text-gray-800">{{ $entrega->descripcion }}</p>
            </div>
            
            <div class="border-b border-gray-100 pb-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Dirección de Entrega</p>
                <p class="text-gray-800 font-medium">📍 {{ $entrega->direccion }}</p>
            </div>

            <div class="pt-2">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Vehículo Asignado</p>
                <p class="text-gray-800">🚚 {{ $entrega->vehiculo->placa ?? 'No asignado' }}</p>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                <p class="text-xs font-bold text-blue-800 uppercase tracking-wider mb-1">Entregar a:</p>
                <p class="text-gray-900 font-bold">👤 {{ $entrega->nombre_contacto ?? 'No registrado' }}</p>
                <p class="text-blue-700 font-medium mt-1">📱 {{ $entrega->celular_contacto ?? 'No registrado' }}</p>
            </div>

        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <form action="/mis-entregas/{{ $entrega->id }}/completar" method="POST">
                @csrf
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition shadow-sm flex justify-center items-center gap-2">
                    ✅ Marcar como Entregado
                </button>
            </form>
        </div>
    </div>
</div>
@endsection