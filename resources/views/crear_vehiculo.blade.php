@extends('layout')

@section('content')
<div style="background: #fff; padding: 30px; border-radius: 12px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <h2 style="margin-bottom: 20px; color: #111827;">Registrar Nuevo Vehículo</h2>

    <form action="/flotilla" method="POST">
        @csrf <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Número de Placa</label>
            <input type="text" name="placa" value="{{ old('placa') }}" style="width: 100%; padding: 10px; border: 1px solid #D1D5DB; border-radius: 6px;">
            @error('placa') <span style="color: #EF4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Modelo del Vehículo</label>
            <input type="text" name="modelo" value="{{ old('modelo') }}" placeholder="Ej. Toyota Hilux 2024" style="width: 100%; padding: 10px; border: 1px solid #D1D5DB; border-radius: 6px;">
            @error('modelo') <span style="color: #EF4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Capacidad de Carga</label>
            <input type="text" name="capacidad" value="{{ old('capacidad') }}" placeholder="Ej. 1.5 Toneladas" style="width: 100%; padding: 10px; border: 1px solid #D1D5DB; border-radius: 6px;">
            @error('capacidad') <span style="color: #EF4444; font-size: 13px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 5px;">Estado Operativo</label>
            <select name="estado" style="width: 100%; padding: 10px; border: 1px solid #D1D5DB; border-radius: 6px;">
                <option value="Disponible">Disponible</option>
                <option value="En ruta">En ruta</option>
                <option value="Mantenimiento">Mantenimiento</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #2563EB; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Guardar Vehículo</button>
            <a href="/flotilla" style="padding: 10px 20px; color: #4B5563; text-decoration: none; font-weight: 600;">Cancelar</a>
        </div>
    </form>
</div>
@endsection