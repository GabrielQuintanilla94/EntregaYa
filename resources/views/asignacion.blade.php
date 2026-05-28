@extends('layout')

@section('content')
<style>
    .page-title { font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 5px; }
    .grid-container { display: grid; grid-template-columns: 1fr 2fr; gap: 24px; margin-top: 24px; }
    
    .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #E5E7EB; }
    .form-group { margin-bottom: 16px; }
    label { display: block; font-weight: 600; color: #374151; margin-bottom: 8px; font-size: 14px; }
    input, select { width: 100%; padding: 10px; border: 1px solid #D1D5DB; border-radius: 6px; font-size: 15px; }
    .btn-submit { width: 100%; background: #2563EB; color: white; padding: 12px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; margin-top: 10px; }
    .btn-submit:hover { background: #1D4ED8; }
    
    .data-table { width: 100%; border-collapse: collapse; text-align: left; }
    .data-table th { padding: 12px; background: #F9FAFB; border-bottom: 1px solid #E5E7EB; font-size: 13px; color: #6B7280; }
    .data-table td { padding: 12px; border-bottom: 1px solid #E5E7EB; font-size: 14px; color: #111827; }
    .alert-success { background: #D1FAE5; color: #065F46; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #34D399; }
</style>

<div>
    <h1 class="page-title">Asignación de Rutas</h1>
    <p style="color: #6B7280;">Asigna paquetes a los conductores y define el vehículo a utilizar.</p>
</div>

@if(session('success'))
    <div class="alert-success" style="margin-top: 15px;">
        ✅ {{ session('success') }}
    </div>
@endif

<div class="grid-container">
    <div class="card">
        <h3 style="margin-bottom: 20px; color: #111827;">📦 Nueva Asignación</h3>
        
        <form action="/asignacion" method="POST">
            @csrf
            <div class="form-group">
                <label>Descripción del Paquete</label>
                <input type="text" name="descripcion" required placeholder="Ej. 2 Cajas de Electrónicos">
            </div>

            <div class="form-group">
                <label>Dirección de Entrega</label>
                <input type="text" name="direccion" required placeholder="Ej. Calle Principal #123, Ciudad">
            </div>

            <div class="form-group">
                <label>Seleccionar Conductor</label>
                <select name="conductor_id" required>
                    <option value="" disabled selected>-- Elige un conductor --</option>
                    @foreach($conductores as $conductor)
                        <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Seleccionar Vehículo (Disponibles)</label>
                <select name="vehiculo_id" required>
                    <option value="" disabled selected>-- Elige un vehículo --</option>
                    @foreach($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->modelo }} (Placa: {{ $vehiculo->placa }})</option>
                    @endforeach
                </select>
                @if($vehiculos->isEmpty())
                    <small style="color: red;">⚠️ No hay vehículos disponibles. Registra uno o espera a que terminen su ruta.</small>
                @endif
            </div>

            <button type="submit" class="btn-submit" @if($vehiculos->isEmpty()) disabled style="background: #9CA3AF; cursor: not-allowed;" @endif>
                Asignar Paquete
            </button>
        </form>
    </div>

    <div class="card" style="overflow-x: auto;">
        <h3 style="margin-bottom: 20px; color: #111827;">🚚 Entregas Recientes</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Paquete / Destino</th>
                    <th>Conductor</th>
                    <th>Vehículo</th>
                    <th>Estado</th>
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
                    <td>
                        @if($entrega->estado == 'Pendiente')
                            <span style="background: #FEF3C7; color: #92400E; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Pendiente</span>
                        @elseif($entrega->estado == 'En camino')
                            <span style="background: #DBEAFE; color: #1E40AF; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">En Camino</span>
                        @else
                            <span style="background: #D1FAE5; color: #065F46; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">Entregado</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #6B7280; padding: 20px;">No hay entregas registradas aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection