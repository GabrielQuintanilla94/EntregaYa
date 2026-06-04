<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EntregaYa - Sistema de Logística')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased h-screen flex flex-col">

    <header class="bg-[#5c3d2e] text-white px-6 py-4 flex justify-between items-center shadow-md z-10">
        <div class="flex items-center space-x-3">
            <span class="text-2xl font-bold tracking-wider">EntregaYa</span>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-sm bg-[#865c49] px-3 py-1 rounded-full">Panel de Control</span>
            <div class="text-right">
                <p class="text-sm font-semibold">{{ Auth::user()->name ?? 'Usuario Conectado' }}</p>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between shadow-sm">
            <div class="p-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Navegación</p>
                
                <nav class="space-y-1">
                    @if(Auth::user()->rol === 'admin')
                        <!-- Menú del Administrador -->
                        <a href="{{ url('/dashboard') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('dashboard') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">📊 Dashboard</a>
                        <a href="{{ url('/conductores') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('conductores') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">👥 Conductores</a>
                        <a href="{{ url('/flotilla') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('flotilla') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">🚚 Flotilla</a>
                        <a href="{{ url('/asignacion') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('asignacion') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">🗺️ Asignación</a>
                        <a href="{{ url('/historial') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('historial') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">📜 Historial Entregas</a>
                        <a href="{{ url('/admin/incidencias') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('admin/incidencias') ? 'text-red-700 bg-red-50 font-bold' : 'text-red-600 hover:bg-red-50 hover:text-red-800 font-medium' }}">⚠️ Ver Incidencias</a>
                    
                    @elseif(Auth::user()->rol === 'conductor')
                        <!-- Menú del Conductor -->
                        <a href="{{ url('/mis-entregas') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('mis-entregas') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">🏠 Inicio (Mis Entregas)</a>
                        <a href="{{ url('/mi-ruta') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('mi-ruta') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">🗺️ Mis Rutas</a>
                        <a href="{{ url('/mi-historial') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('mi-historial') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">📜 Historial de Entregas</a>
                        <a href="{{ url('/reportar-incidencia') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->is('reportar-incidencia') ? 'text-gray-700 bg-gray-100 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">⚠️ Reportar Incidencia</a>
                    @endif
                </nav>

            </div>

            <div class="p-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition cursor-pointer">
                        🚪 Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</body>
</html>