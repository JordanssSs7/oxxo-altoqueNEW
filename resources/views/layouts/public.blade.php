<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXXO Al Toque</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo-oxxo.png') }}" alt="OXXO" class="h-12">
            </a>

            {{-- Links de navegación --}}
            <div class="flex gap-8 text-gray-700 font-medium">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition">Inicio</a>
                <a href="#" class="hover:text-red-600 transition">Productos</a>
                <a href="#" class="hover:text-red-600 transition">Promociones</a>
                <a href="#" class="hover:text-red-600 transition">Novedades</a>
            </div>

            {{-- Botón de sesión --}}
            @auth
                <a href="{{ route('dashboard') }}"
                   class="bg-red-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-red-700 transition">
                    Mi cuenta
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="bg-red-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-red-700 transition">
                    Iniciar sesión
                </a>
            @endauth

        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main>
        @yield('contenido')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white py-6 text-center">
        <p class="text-sm text-gray-400">&copy; 2026 OXXO Al Toque &mdash; Grupo 04 | Tecsup</p>
    </footer>

</body>
</html>
