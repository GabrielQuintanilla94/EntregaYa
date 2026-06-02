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
                <h1 class="text-3xl font-bold text-gray-800">Ruta Activa</h1>
            </div>
            <p class="text-gray-500 ml-9">Fecha: {{ date('d/m/Y') }}</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Iniciar Navegación
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-200px)] min-h-[600px]">
        
        <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Paradas</h2>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full">{{ $entregas->count() }} Paquetes</span>
            </div>
            
            <div class="p-4 overflow-y-auto flex-1">
                <div class="relative border-l-2 border-blue-500 ml-3 space-y-8 pb-4">
                    
                    @forelse($entregas as $entrega)
                        <div class="relative pl-6">
                            @if($entrega->estado == 'En camino')
                                <span class="absolute -left-[11px] top-1 bg-blue-600 rounded-full w-5 h-5 border-4 border-white shadow-sm"></span>
                                <div class="bg-blue-50 border border-blue-100 p-3 rounded-lg -mt-2">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="text-xs font-bold text-blue-700 bg-blue-100 px-2 py-0.5 rounded">Siguiente Parada</span>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-md">{{ $entrega->direccion }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ $entrega->descripcion }}</p>
                                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-1.5 rounded text-sm transition">
                                        Confirmar Llegada
                                    </button>
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
                            No hay entregas pendientes asignadas a tu ruta en este momento.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-gray-200 rounded-xl shadow-sm border border-gray-200 relative overflow-hidden">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124864.04332824391!2d-89.3444455!3d13.6914784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6330691e813133%3A0x6b490409a63b0e36!2sSan%20Salvador%2C%20El%20Salvador!5e0!3m2!1ses!2ssv!4v1717282500000!5m2!1ses!2ssv" 
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