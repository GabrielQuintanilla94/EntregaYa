@extends('layout')

@section('content')
<style>
    .page-title { font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 5px; }
    .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #E5E7EB; margin-top: 24px; }
    .data-table { width: 100%; border-collapse: collapse; text-align: left; }
    .data-table th { padding: 16px; background: #F9FAFB; border-bottom: 1px solid #E5E7EB; font-size: 13px; color: #6B7280; text-transform: uppercase; }
    .data-table td { padding: 16px; border-bottom: 1px solid #E5E7EB; font-size: 14px; color: #111827; }
</style>

<div>
    <h1 class="page-title">Historial de Reportes</h1>
    <p style="color: #6B7280;">Registro de todos los paquetes que ya fueron entregados exitosamente.</p>
</div>

<div class="card" style="overflow-x: auto;">
    <table class="data-table">
        <thead>
            <tr>
                <th>Paquete / Destino</th>
                <th>Entregado Por</th>
                <th>Vehículo Usado</th>
                <th>Fecha de Entrega</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entregas as $entrega)
            <tr>
                <td>
                    <strong>{{ $entrega->descripcion }}</strong><br>
                    <span style="color: #6B7280; font-size: 12px;">📍 {{ $entrega->direccion }}</span>
                </td>
                <td>{{ $entrega->conductor->name }}</td>
                <td>{{ $entrega->vehiculo->placa }}</td>
                <td style="color: #10B981; font-weight: 600;">{{ $entrega->updated_at->format('d/m/Y h:i A') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #6B7280; padding: 30px;">Aún no hay registros de entregas completadas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection