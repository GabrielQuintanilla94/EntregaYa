@extends('layouts.app')

@section('title', 'Detalle de Entrega - EntregaYa')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ url('/mis-entregas') }}" class="inline-flex items-center text-gray-500 hover:text-[#5c3d2e] font-medium mb-6 transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Volver a Mis Entregas
    </a>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2">
            
            <div class="p-8 border-b md:border-b-0 md:border-r border-gray-200">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full inline-block mb-2">Guía #{{ str_pad($entrega->id, 4, '0', STR_PAD_LEFT) }}</span>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $entrega->direccion }}</h1>
                    </div>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full uppercase">{{ $entrega->estado }}</span>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Descripción del Paquete</p>
                        <p class="text-gray-800 font-medium mt-1">{{ $entrega->descripcion }}</p>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Detalles de Contacto</p>
                        <p class="text-gray-800 font-medium mt-1">👤 Cliente Registrado</p>
                        <p class="text-gray-600 text-sm mt-1">📞 Teléfono: (503) 7000-0000</p>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Instrucciones Especiales</p>
                        <p class="text-gray-600 text-sm mt-1 italic">"Llamar al llegar al portón principal."</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="h-64 bg-gray-200 w-full relative">
                    <iframe 
                        src="https://maps.google.com/maps?q=San+Salvador,+El+Salvador&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>

                <div class="p-6 bg-gray-50 flex-1 flex flex-col justify-center gap-4">
                    
                    <form action="{{ url('/mis-entregas/' . $entrega->id . '/completar') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300 flex justify-center items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Marcar como Entregado
                        </button>
                    </form>

                    <a href="{{ url('/reportar-incidencia') }}" class="w-full bg-white border border-red-200 text-red-600 hover:bg-red-50 font-bold py-3 px-4 rounded-lg shadow-sm transition duration-300 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Reportar Incidencia
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection