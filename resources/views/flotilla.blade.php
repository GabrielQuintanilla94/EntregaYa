@extends('layout')

@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .page-title { font-size: 26px; font-weight: 800; color: #111827; }
    .btn-primary { background-color: #2563EB; color: #FFFFFF; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; transition: background 0.3s; }
    .btn-primary:hover { background-color: #1D4ED8; }
    
    /* Contenedor de Tabla */
    .table-container { background-color: #FFFFFF; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #E5E7EB; }
    .data-table { width: 100%; border-collapse: collapse; text-align: left; }
    .data-table th { background-color: #F9FAFB; padding: 16px 24px; font-size: 13px; font-weight: 700; color: #374151; text-transform: uppercase; border-bottom: 1px solid #E5E7EB; }
    .data-table td { padding: 16px 24px; font-size: 15px; color: #4B5563; border-bottom: 1px solid #E5E7EB; }
    
    /* Estados */
    .badge { padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 600; display: inline-block; }
    .badge-disponible { background-color: #D1FAE5; color: #065F46; }
    .badge-ruta { background-color: #DBEAFE; color: #1E40AF; }
    .badge-mantenimiento { background-color: #FEE2E2; color: #991B1B; }
</style>

<div class="page-header">
    <div>
        <h1 class="page-title">Flotilla de Vehículos</h1>
        <p style="color: #6B7280; margin-top: 4px;">Control, disponibilidad y datos de cada unidad de reparto.</p>
    </div>
    <a href="/flotilla/crear" class="btn-primary" style="display: inline-block; text-decoration: none;">+ Registrar Vehículo</a>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Modelo / Vehículo</th>
                <th>Capacidad de Carga</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
            <tr>
                <td style="font-weight: 600; color: #111827;">{{ $vehiculo->placa }}</td>
                <td>{{ $vehiculo->modelo }}</td>
                <td>{{ $vehiculo->capacidad }}</td>
                <td>
                    @if($vehiculo->estado == 'Disponible')
                        <span class="badge badge-disponible">Disponible</span>
                    @elseif($vehiculo->estado == 'En ruta')
                        <span class="badge badge-ruta">En ruta</span>
                    @else
                        <span class="badge badge-mantenimiento">Mantenimiento</span>
                    @endif
                </td>
                <td>
                    <a href="#" style="color: #2563EB; text-decoration: none; margin-right: 12px; font-weight: 500;">Editar</a>
                    <a href="#" style="color: #EF4444; text-decoration: none; font-weight: 500;">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection