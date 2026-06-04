@extends('layouts.app')

@section('title', 'Mi Ruta - EntregaYa')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ url('/mis-entregas') }}" class="text-gray-500 hover:text-blue-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">Mi Ruta Activa</h1>
            </div>
            <p class="text-gray-500 ml-9">Toca un paquete para ver su ubicación en el mapa.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-200px)] min-h-[600px]">
        
        <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Seleccionar Destino</h2>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full">{{ $entregas->count() }} Paquetes</span>
            </div>
            
            <div class="p-4 overflow-y-auto flex-1 bg-gray-50">
                <div class="space-y-3">
                    
                    @forelse($entregas as $entrega)
                        @php
                            // Preparamos la dirección para Google Maps
                            $direccionUrl = urlencode($entrega->direccion . ', El Salvador');
                        @endphp
                        
                        <div onclick="cambiarMapa('{{ $direccionUrl }}', this)" 
                             class="tarjeta-destino cursor-pointer bg-white border-2 {{ $loop->first ? 'border-blue-500 shadow-md' : 'border-gray-200 hover:border-blue-300' }} p-4 rounded-xl transition-all relative">
                            
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded">Guía #{{ $entrega->id }}</span>
                            </div>
                            <h3 class="font-bold text-gray-800 text-md leading-tight mt-1">{{ $entrega->direccion }}</h3>
                            <p class="text-sm text-gray-500 mt-1 mb-3 truncate">{{ $entrega->descripcion }}</p>
                            
                            <a href="{{ route('conductor.detalle', $entrega->id) }}" class="block text-center w-full bg-blue-50 hover:bg-blue-100 text-blue-700 py-2 rounded-lg text-sm transition font-bold">
                                Gestionar Entrega
                            </a>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 text-sm py-6 bg-white rounded-lg border border-dashed border-gray-300">
                            No hay entregas pendientes para mostrar en el mapa.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-gray-200 rounded-xl shadow-sm border border-gray-200 relative overflow-hidden">
            @php
                // Por defecto, carga la ubicación del primer paquete
                $primeraDireccion = $entregas->first() ? urlencode($entregas->first()->direccion . ', El Salvador') : 'San+Salvador,+El+Salvador';
            @endphp
            
            <iframe 
                id="mapa-iframe"
                src="https://maps.google.com/maps?q={{ $primeraDireccion }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
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

<script>
    function cambiarMapa(direccion, elementoClick) {
        // 1. Cambiamos la URL del mapa al nuevo destino
        const iframe = document.getElementById('mapa-iframe');
        iframe.src = `https://maps.google.com/maps?q=${direccion}&t=&z=15&ie=UTF8&iwloc=&output=embed`;

        // 2. Le quitamos el borde azul a todas las tarjetas
        const todasLasTarjetas = document.querySelectorAll('.tarjeta-destino');
        todasLasTarjetas.forEach(tarjeta => {
            tarjeta.classList.remove('border-blue-500', 'shadow-md');
            tarjeta.classList.add('border-gray-200');
        });

        // 3. Le ponemos el borde azul solo a la tarjeta que el conductor tocó
        elementoClick.classList.remove('border-gray-200');
        elementoClick.classList.add('border-blue-500', 'shadow-md');
    }
</script>
@endsection