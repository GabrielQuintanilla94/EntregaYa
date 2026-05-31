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
                <p class="text-sm font-semibold">Usuario Conectado</p>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between shadow-sm">
            <div class="p-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Navegación</p>
                <nav class="space-y-1">
                    <a href="#" class="flex items-center px-4 py-3 text-gray-700 bg-gray-100 font-medium rounded-lg transition">
                        <span>🏠 Inicio</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition">
                        <span>🗺️ Mis Rutas</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition">
                        <span>📜 Historial de Entregas</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition">
                        <span>⚠️ Reportar Incidencia</span>
                    </a>
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