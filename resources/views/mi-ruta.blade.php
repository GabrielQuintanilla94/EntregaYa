{{-- Extendemos el layout principal de la aplicación --}}
@extends('layouts.app')

{{-- Definimos el título de la página --}}
@section('title', 'Mi Ruta - EntregaYa')

{{-- Inicia la sección de contenido principal --}}
@section('content')
<div class="max-w-6xl mx-auto">
    
    {{-- Encabezado de la vista con botón de retroceso y título --}}
    <div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                {{-- Botón para regresar a la lista de "Mis Entregas" --}}
                <a href="{{ url('/mis-entregas') }}" class="text-gray-500 hover:text-blue-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">Mi Ruta Activa</h1>
            </div>
            <p class="text-gray-500 ml-9">Toca un paquete para ver su ubicación en el mapa.</p>
        </div>
    </div>

    {{-- Contenedor principal de 2 columnas: Lista de paquetes a la izquierda, Mapa a la derecha --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-200px)] min-h-[600px]">
        
        {{-- COLUMNA IZQUIERDA: Lista de destinos/paquetes --}}
        <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            
            {{-- Cabecera de la lista de paquetes --}}
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Seleccionar Destino</h2>
                {{-- Muestra la cantidad total de entregas pendientes en la lista --}}
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full">{{ $entregas->count() }} Paquetes</span>
            </div>
            
            {{-- Cuerpo scrollable con la lista de tarjetas de entregas --}}
            <div class="p-4 overflow-y-auto flex-1 bg-gray-50">
                <div class="space-y-3">
                    
                    {{-- Iteramos sobre cada entrega asignada al conductor --}}
                    @forelse($entregas as $entrega)
                        @php
                            // Codificamos la dirección para usarla en la URL de Google Maps de forma segura
                            $direccionUrl = urlencode($entrega->direccion . ', El Salvador');
                        @endphp
                        
                        {{-- Tarjeta clickeable de la entrega. Llama a la función JavaScript 'cambiarMapa' --}}
                        <div onclick="cambiarMapa('{{ $direccionUrl }}', this)" 
                             class="tarjeta-destino cursor-pointer bg-white border-2 {{ $loop->first ? 'border-blue-500 shadow-md' : 'border-gray-200 hover:border-blue-300' }} p-4 rounded-xl transition-all relative">
                            
                            {{-- Número de guía de la entrega --}}
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded">Guía #{{ $entrega->id }}</span>
                            </div>
                            
                            {{-- Información principal: Dirección y descripción corta --}}
                            <h3 class="font-bold text-gray-800 text-md leading-tight mt-1">{{ $entrega->direccion }}</h3>
                            <p class="text-sm text-gray-500 mt-1 mb-3 truncate">{{ $entrega->descripcion }}</p>
                            
                            {{-- Enlace para ir al detalle completo y poder gestionar/completar la entrega --}}
                            <a href="{{ route('conductor.detalle', $entrega->id) }}" class="block text-center w-full bg-blue-50 hover:bg-blue-100 text-blue-700 py-2 rounded-lg text-sm transition font-bold">
                                Gestionar Entrega
                            </a>
                        </div>
                    @empty
                        {{-- Mensaje de estado vacío en caso de no tener entregas --}}
                        <div class="text-center text-gray-500 text-sm py-6 bg-white rounded-lg border border-dashed border-gray-300">
                            No hay entregas pendientes para mostrar en el mapa.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: Visualizador del Mapa Embebido --}}
        <div class="lg:col-span-2 bg-gray-200 rounded-xl shadow-sm border border-gray-200 relative overflow-hidden">
            @php
                // Determinamos la ubicación inicial del mapa. Usa la primera entrega o la capital por defecto.
                $primeraDireccion = $entregas->first() ? urlencode($entregas->first()->direccion . ', El Salvador') : 'San+Salvador,+El+Salvador';
            @endphp
            
            {{-- Iframe de Google Maps incrustado --}}
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

{{-- Script encargado de la interactividad del mapa y tarjetas --}}
<script>
    /**
     * Actualiza el iframe del mapa con una nueva dirección y resalta visualmente la tarjeta seleccionada.
     * 
     * @param {string} direccion - La dirección URL-codificada para Google Maps.
     * @param {HTMLElement} elementoClick - El nodo DOM de la tarjeta en la que se hizo clic.
     */
    function cambiarMapa(direccion, elementoClick) {
        // 1. Actualiza la fuente (src) del iframe de Google Maps con la nueva dirección
        const iframe = document.getElementById('mapa-iframe');
        iframe.src = `https://maps.google.com/maps?q=${direccion}&t=&z=15&ie=UTF8&iwloc=&output=embed`;

        // 2. Restablece el estilo de todas las tarjetas para que ninguna parezca seleccionada
        const todasLasTarjetas = document.querySelectorAll('.tarjeta-destino');
        todasLasTarjetas.forEach(tarjeta => {
            tarjeta.classList.remove('border-blue-500', 'shadow-md'); // Quitar color y sombra azul
            tarjeta.classList.add('border-gray-200');                 // Añadir borde gris
        });

        // 3. Aplica estilos de "tarjeta activa/seleccionada" (borde y sombra azul) al elemento clicado
        elementoClick.classList.remove('border-gray-200');
        elementoClick.classList.add('border-blue-500', 'shadow-md');
    }
</script>
@endsection