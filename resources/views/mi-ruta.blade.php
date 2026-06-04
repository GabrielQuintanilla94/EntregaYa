@extends('layouts.app')

@section('title', 'Mi Ruta - EntregaYa')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ url('/mis-entregas') }}" class="text-gray-500 hover:text-[#5c3d2e] transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">Mi Ruta Activa</h1>
            </div>
            <p class="text-gray-500 ml-9">Fecha: {{ date('d/m/Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-200px)] min-h-[600px]">
        
        <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Orden de Paradas</h2>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full">{{ $entregas->count() }} Paquetes</span>
            </div>
            
            <div class="p-4 overflow-y-auto flex-1">
                <div class="relative border-l-2 border-[#5c3d2e] ml-3 space-y-8 pb-4">
                    
                    @forelse($entregas as $entrega)
                        <div class="relative pl-6">
                            @if($loop->first)
                                <span class="absolute -left-[11px] top-1 bg-orange-500 rounded-full w-5 h-5 border-4 border-white shadow-sm"></span>
                                <div class="bg-orange-50 border border-orange-200 p-3 rounded-lg -mt-2 shadow-sm">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="text-xs font-bold text-orange-700 bg-orange-100 px-2 py-0.5 rounded">Siguiente Destino</span>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-md">{{ $entrega->direccion }}</h3>
                                    <p class="text-sm text-gray-600 mb-3">{{ $entrega->descripcion }}</p>
                                    
                                    <a href="{{ route('conductor.detalle', $entrega->id) }}" class="block text-center w-full bg-orange-600 hover:bg-orange-700 text-white py-1.5 rounded text-sm transition font-medium">
                                        Gestionar Entrega
                                    </a>
                                </div>
                            @else
                                <span class="absolute -left-[11px] top-1 bg-gray-300 rounded-full w-5 h-5 border-4 border-white"></span>
                                <div>
                                    <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded">Guía #{{ $entrega->id }}</span>
                                    <h3 class="font-bold text-gray-700 text-md mt-1">{{ $entrega->direccion }}</h3>
                                    <p class="text-sm text-gray-500">{{ $entrega->descripcion }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="pl-4 text-gray-500 text-sm">
                            No hay entregas pendientes asignadas a tu ruta.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-gray-200 rounded-xl shadow-sm border border-gray-200 relative overflow-hidden">
            @php
                // Tomamos el primer paquete pendiente para centrar el mapa ahí
                $siguienteParada = $entregas->first();
                // Formateamos la dirección para que Google Maps la entienda (Le agregamos El Salvador para mayor precisión)
                $direccionMapa = $siguienteParada ? urlencode($siguienteParada->direccion . ', El Salvador') : 'San+Salvador,+El+Salvador';
            @endphp
            
            <iframe 
                src="https://maps.google.com/maps?q={{ $direccionMapa }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                width="100%" 
                height="100%" 
                style="border:0; min-height: 500px;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>
</div>
@endsection