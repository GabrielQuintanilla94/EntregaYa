@extends('layout')

@section('content')
<style>
    .page-title { font-size: 24px; font-weight: 800; color: #111827; margin-bottom: 5px; }
    .mobile-grid { display: grid; grid-template-columns: 1fr; gap: 16px; margin-top: 20px; }
    
    .delivery-card { 
        background: white; 
        padding: 20px; 
        border-radius: 12px; 
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); 
        border: 1px solid #E5E7EB; 
        border-left: 5px solid #F59E0B; /* Amarillo por defecto (Pendiente) */
    }
    .delivery-card.en-camino { border-left-color: #3B82F6; /* Azul para en camino */ }
    
    .delivery-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .status-badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
    .status-pendiente { background: #FEF3C7; color: #92400E; }
    .status-encamino { background: #DBEAFE; color: #1E40AF; }
    
    .delivery-info h3 { margin: 0 0 5px 0; color: #111827; font-size: 18px; }
    .delivery-info p { margin: 0 0 10px 0; color: #6B7280; font-size: 14px; }
    
    .btn-action { 
        display: block; 
        width: 100%; 
        text-align: center; 
        background: #111827; 
        color: white; 
        padding: 12px; 
        border-radius: 8px; 
        text-decoration: none; 
        font-weight: bold; 
        margin-top: 15px;
    }
    .btn-action:hover { background: #374151; }
    .empty-state { text-align: center; padding: 40px; color: #6B7280; background: white; border-radius: 12px; }
</style>

<div>
    <h1 class="page-title">Mis Entregas Hoy</h1>
    <p style="color: #6B7280;">Revisa tu ruta y marca los paquetes entregados.</p>
</div>

<div class="mobile-grid">
    @forelse($entregas as $entrega)
        <div class="delivery-card {{ $entrega->estado == 'En camino' ? 'en-camino' : '' }}">
            <div class="delivery-header">
                <span style="font-size: 12px; color: #6B7280;">ID: #{{ $entrega->id }}</span>
                @if($entrega->estado == 'Pendiente')
                    <span class="status-badge status-pendiente">Pendiente</span>
                @else
                    <span class="status-badge status-encamino">En Camino</span>
                @endif
            </div>
            
            <div class="delivery-info">
                <h3>{{ $entrega->descripcion }}</h3>
                <p>📍 {{ $entrega->direccion }}</p>
                <p>🚚 Vehículo asignado: <strong>{{ $entrega->vehiculo->placa }}</strong></p>
            </div>

            <!-- Este botón nos llevará a la vista de detalles más adelante -->
            <a href="{{ route('conductor.detalle', $entrega->id) }}" class="btn-action">Ver Detalles / Actualizar</a>
        </div>
    @empty
        <div class="empty-state">
            <h2>🎉 ¡Todo limpio!</h2>
            <p>No tienes entregas pendientes en este momento. Tómate un descanso.</p>
        </div>
    @endforelse
</div>
@endsection