@extends('layouts.app')

@section('title', 'Mis Entregas - EntregaYa')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Mi Ruta de Hoy</h1>
            <p class="text-gray-500 mt-1">Tienes 3 paquetes pendientes de entrega.</p>
        </div>
        <div class="text-right">
            <span class="bg-green-100 text-green-800 text-sm font-semibold px-4 py-2 rounded-full">
                Vehículo Activo: Panel 01
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Entregas Pendientes</p>
                <h3 class="text-2xl font-bold text-gray-800">3</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-green-100 text-green-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Entregas Completadas</p>
                <h3 class="text-2xl font-bold text-gray-800">12</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-red-100 text-red-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Mis Incidencias</p>
                <h3 class="text-2xl font-bold text-gray-800">1</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-4">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Paquetes Asignados</h2>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 flex justify-between items-center hover:shadow-md transition">
                <div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded mb-2 inline-block">Guía #EY-9081</span>
                    <h3 class="font-bold text-gray-800 text-lg">Colonia Escalón, Calle 1</h3>
                    <p class="text-sm text-gray-500 mt-1">Cliente: María González - Tel: 7000-0000</p>
                </div>
                <div class="text-right">
                    <button class="bg-[#5c3d2e] hover:bg-[#4a3125] text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        Ver Detalles
                    </button>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 flex justify-between items-center hover:shadow-md transition">
                <div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded mb-2 inline-block">Guía #EY-9082</span>
                    <h3 class="font-bold text-gray-800 text-lg">Santa Elena, Avenida Sur</h3>
                    <p class="text-sm text-gray-500 mt-1">Cliente: Carlos Pérez - Tel: 7111-1111</p>
                </div>
                <div class="text-right">
                    <button class="bg-[#5c3d2e] hover:bg-[#4a3125] text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        Ver Detalles
                    </button>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Acciones de Ruta</h2>
            
            <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl p-8 text-center h-64 flex flex-col justify-center items-center">
                <span class="text-3xl mb-3">🛠️</span>
                <h3 class="text-gray-700 font-bold mb-1">Módulo Pendiente</h3>
                <p class="text-sm text-gray-500">
                    Aquí el compañero integrará su funcionalidad (Mapa GPS, Confirmación de entrega o Escáner QR).
                </p>
            </div>
        </div>

    </div>
</div>
@endsection