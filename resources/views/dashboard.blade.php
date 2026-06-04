@extends('layouts.app')

@section('title', 'Dashboard - EntregaYa')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Panel de Control Operativo</h1>
    <p class="text-gray-500">Resumen en tiempo real del sistema de EntregaYa.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-blue-500 flex items-center justify-between hover:shadow-md transition">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">👥 Conductores</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalConductores }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-green-500 flex items-center justify-between hover:shadow-md transition">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">🚚 Vehículos Libres</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $vehiculosDisponibles }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-yellow-500 flex items-center justify-between hover:shadow-md transition">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">📦 En Curso</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $entregasActivas }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-purple-500 flex items-center justify-between hover:shadow-md transition">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">✅ Completadas</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $entregasCompletadas }}</h3>
        </div>
    </div>
</div>
@endsection