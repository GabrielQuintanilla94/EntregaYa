@extends('layouts.app')

@section('title', 'Conductores - EntregaYa')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Lista de Conductores</h1>
    <p class="text-gray-500 mt-1">Personal registrado y disponible para asignar entregas.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">ID</th>
                    <th class="p-4 font-semibold">Nombre Completo</th>
                    <th class="p-4 font-semibold">Correo Electrónico</th>
                    <th class="p-4 font-semibold">Fecha de Registro</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($conductores as $conductor)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-bold text-gray-800">#{{ $conductor->id }}</td>
                    <td class="p-4 text-gray-700 font-medium">{{ $conductor->name }}</td>
                    <td class="p-4 text-blue-600">{{ $conductor->email }}</td>
                    <td class="p-4 text-gray-500">{{ $conductor->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500 bg-gray-50 italic">No hay conductores registrados todavía.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection