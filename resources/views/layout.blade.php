<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EntregaYa - Panel de Control</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background-color: #F3F4F6; color: #1F2937; height: 100vh; overflow: hidden; }
        
        /* Barra Lateral */
        .sidebar { width: 260px; background-color: #1E293B; color: #FFFFFF; display: flex; flex-direction: column; padding: 24px 16px; }
        .sidebar-brand { font-size: 22px; font-weight: 800; color: #3B82F6; margin-bottom: 32px; padding-left: 8px; text-transform: uppercase; letter-spacing: 1px; }
        .sidebar-menu { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item a { display: block; padding: 12px 16px; color: #94A3B8; text-decoration: none; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; }
        .sidebar-item a:hover, .sidebar-item.active a { background-color: #334155; color: #FFFFFF; }
        
        /* Área Principal de Contenido */
        .main-content { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow-y: auto; }
        .top-header { background-color: #FFFFFF; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E5E7EB; min-height: 70px; }
        .user-profile { display: flex; align-items: center; gap: 12px; font-weight: 600; color: #4B5563; }
        .content-body { padding: 32px; max-width: 1200px; width: 100%; align-self: center; flex: 1; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">EntregaYa</div>
       <ul class="sidebar-menu">
         @if(Auth::user()->rol === 'admin')
             <li class="sidebar-item"><a href="/dashboard">📊 Dashboard</a></li>
             <li class="sidebar-item"><a href="/conductores">👥 Conductores</a></li>
             <li class="sidebar-item"><a href="/flotilla">🚚 Gestión de Flotilla</a></li>
             <li class="sidebar-item"><a href="/asignacion">🗺️ Asignación de Rutas</a></li>
             <li class="sidebar-item"><a href="/historial">📃​ Historial Entregas</a></li>
         @elseif(Auth::user()->rol === 'conductor')
             <li class="sidebar-item"><a href="/mis-entregas">📦 Mis Entregas</a></li>
             <li class="sidebar-item"><a href="/mi-historial">✅ Mi Historial</a></li>
         @endif
        </ul>

        <div style="margin-top: auto; padding: 20px;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="width: 100%; padding: 10px; background-color: #ef4444; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                    🚪 Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="top-header">
            <h2 style="font-size: 18px; font-weight: 600; color: #6B7280;">Módulo de Operaciones Logísticas</h2>
            <div class="user-profile">
                <span>👤 Administrador</span>
            </div>
        </div>

        <div class="content-body">
            @yield('content') </div>
    </div>

</body>
</html>