@extends('layout')

@section('content')
<style>
    .page-title { font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 5px; }
    .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #E5E7EB; margin-top: 24px; }
    
    .data-table { width: 100%; border-collapse: collapse; text-align: left; }
    .data-table th { padding: 16px; background: #F9FAFB; border-bottom: 1px solid #E5E7EB; font-size: 13px; color: #6B7280; text-transform: uppercase; font-weight: 700; }
    .data-table td { padding: 16px; border-bottom: 1px solid #E5E7EB; font-size: 15px; color: #111827; }
    .empty-state { text-align: center; padding: 40px; color: #6B7280; font-style: italic; }
</style>

<div>
    <h1 class="page-title">Lista de Conductores</h1>
    <p style="color: #6B7280;">Personal registrado y disponible para asignar entregas.</p>
</div>

<div class="card" style="overflow-x: auto;">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Correo Electrónico</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @if($conductores->isEmpty())
                <tr>
                    <td colspan="4" class="empty-state">No hay conductores registrados todavía.</td>
                </tr>
            @else
                @foreach($conductores as $conductor)
                <tr>
                    <td><strong>#{{ $conductor->id }}</strong></td>
                    <td>{{ $conductor->name }}</td>
                    <td style="color: #2563EB;">{{ $conductor->email }}</td>
                    <td>{{ $conductor->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection