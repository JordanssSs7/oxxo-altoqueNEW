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
                <a href="{{ route('catalogo') }}" class="hover:text-red-600 transition">Productos</a>
                <a href="{{ route('promociones') }}" class="hover:text-red-600 transition">Promociones</a>
                <a href="{{ route('sucursales') }}" class="hover:text-red-600 transition">Sucursales</a>
                @auth
                    <a href="{{ route('pedidos.index') }}" class="hover:text-red-600 transition">Mis pedidos</a>
                @endauth
            </div>

            {{-- Carrito + botón sesión --}}
            <div class="flex items-center gap-3">
                @auth
                <a href="{{ route('carrito.index') }}" class="relative inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-red-50 transition text-xl">
                    🛒
                    @php $cartCount = count(session('carrito', [])); @endphp
                    @if($cartCount > 0)
                    <span id="badge-carrito" style="position:absolute;top:-4px;right:-4px;background:#dc2626;color:white;font-size:11px;font-weight:700;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                        {{ $cartCount }}
                    </span>
                    @endif
                </a>
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

        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main>
        @yield('contenido')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-100 border-t border-gray-200 pt-14 pb-6">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Columnas --}}
            <div class="grid grid-cols-4 gap-10 mb-12">

                {{-- Logo --}}
                <div>
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo-oxxo.png') }}" alt="OXXO Al Toque" class="h-12 mb-4">
                    </a>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Tu tienda de conveniencia en línea. Pide y recoge en minutos.
                    </p>
                </div>

                {{-- Conócenos --}}
                <div>
                    <h4 class="font-semibold text-gray-700 mb-4">Conócenos</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="{{ route('home') }}#como-funciona" class="hover:text-red-600 transition">¿Cómo funciona?</a></li>
                        <li><a href="{{ route('terminos') }}" class="hover:text-red-600 transition">Términos y condiciones</a></li>
                        <li><a href="{{ route('privacidad') }}" class="hover:text-red-600 transition">Política de privacidad</a></li>
                    </ul>
                </div>

                {{-- Redes sociales --}}
                <div>
                    <h4 class="font-semibold text-gray-700 mb-4">Redes sociales</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="https://www.instagram.com/oxxoperu/" target="_blank" class="hover:text-red-600 transition">Instagram</a></li>
                        <li><a href="https://www.facebook.com/oxxoperuoficial" target="_blank" class="hover:text-red-600 transition">Facebook</a></li>
                        <li><a href="https://www.tiktok.com/@oxxoperu?lang=es" target="_blank" class="hover:text-red-600 transition">TikTok</a></li>
                    </ul>
                </div>

                {{-- Mi cuenta --}}
                <div>
                    <h4 class="font-semibold text-gray-700 mb-4">Mi cuenta</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="{{ route('catalogo') }}" class="hover:text-red-600 transition">Ver productos</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="hover:text-red-600 transition">Mi perfil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="hover:text-red-600 transition bg-transparent border-none p-0 cursor-pointer text-sm text-gray-500">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-red-600 transition">Iniciar sesión</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-red-600 transition">Crear cuenta</a></li>
                        @endauth
                    </ul>
                </div>

            </div>

            {{-- Línea divisoria y copyright --}}
            <div class="border-t border-gray-200 pt-6 text-center text-xs text-gray-400">
                &copy; 2026 OXXO Al Toque &mdash; Grupo 04 | Tecsup
            </div>

        </div>
    </footer>

</body>
</html>
