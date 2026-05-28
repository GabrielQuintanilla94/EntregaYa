@extends('layout')

@section('content')
<style>
    .page-title { font-size: 26px; font-weight: 800; color: #111827; margin-bottom: 5px; }
    .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-top: 24px; }
    .stat-card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #E5E7EB; border-left: 5px solid #2563EB; }
    .stat-card.green { border-left-color: #10B981; }
    .stat-card.yellow { border-left-color: #F59E0B; }
    .stat-card.purple { border-left-color: #8B5CF6; }
    .stat-title { color: #6B7280; font-size: 14px; font-weight: 600; text-transform: uppercase; margin-bottom: 10px; }
    .stat-number { font-size: 32px; font-weight: 800; color: #111827; }
</style>

<div>
    <h1 class="page-title">Panel de Control Operativo</h1>
    <p style="color: #6B7280;">Resumen en tiempo real del sistema de EntregaYa.</p>
</div>

<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-title">👥 Conductores Activos</div>
        <div class="stat-number">{{ $totalConductores }}</div>
    </div>

    <div class="stat-card green">
        <div class="stat-title">🚚 Vehículos Disponibles</div>
        <div class="stat-number">{{ $vehiculosDisponibles }}</div>
    </div>

    <div class="stat-card yellow">
        <div class="stat-title">📦 Entregas en Curso</div>
        <div class="stat-number">{{ $entregasActivas }}</div>
    </div>

    <div class="stat-card purple">
        <div class="stat-title">✅ Entregas Completadas</div>
        <div class="stat-number">{{ $entregasCompletadas }}</div>
    </div>
</div>
@endsection