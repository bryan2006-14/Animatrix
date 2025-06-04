<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Películas Animadas</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    {{-- Barra de navegación principal --}}
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                {{-- Logo / Marca --}}
                <div class="flex-shrink-0 flex items-center space-x-2">
                    <svg class="h-7 w-7 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a1 1 0 00-1 1v12a1 1 0 001 1h3l3 3v-3h6a1 1 0 001-1V4a1 1 0 00-1-1H4z" />
                    </svg>
                    <span class="text-xl font-bold tracking-tight text-indigo-700">Animatrix</span>
                </div>

                {{-- Menú de navegación principal --}}
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('animaciones.index') }}"
                       class="@if(request()->routeIs('animaciones.*')) text-indigo-600 border-b-2 border-indigo-600 @else text-gray-600 hover:text-indigo-600 @endif text-sm font-medium transition duration-200">
                        Películas
                    </a>
                    <a href="{{ route('estudios.index') }}"
                       class="@if(request()->routeIs('estudios.*')) text-indigo-600 border-b-2 border-indigo-600 @else text-gray-600 hover:text-indigo-600 @endif text-sm font-medium transition duration-200">
                        Estudios
                    </a>
                </div>

                {{-- Menú móvil --}}
                <div class="md:hidden flex items-center">
                    <button id="mobile-toggle" class="text-gray-600 hover:text-indigo-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Menú móvil desplegable --}}
        <div id="mobile-menu" class="md:hidden hidden px-4 pt-2 pb-4 space-y-2 bg-white border-t border-gray-200">
            <a href="{{ route('animaciones.index') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium @if(request()->routeIs('animaciones.*')) bg-indigo-100 text-indigo-700 @else text-gray-700 hover:bg-gray-100 @endif">
                Películas
            </a>
            <a href="{{ route('estudios.index') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium @if(request()->routeIs('estudios.*')) bg-indigo-100 text-indigo-700 @else text-gray-700 hover:bg-gray-100 @endif">
                Estudios
            </a>
        </div>
    </nav>

    {{-- Contenedor principal --}}
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Alertas de sesión --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-6">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Contenido dinámico --}}
        @yield('content')
    </main>

    {{-- Script para el menú móvil --}}
    <script>
        document.getElementById('mobile-toggle').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
