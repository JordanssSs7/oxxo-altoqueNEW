@extends('layouts.public')

@section('contenido')

{{-- ========== HERO ========== --}}
<section class="grid grid-cols-2 min-h-[92vh]">

    {{-- Columna izquierda: imagen --}}
    <div class="relative overflow-hidden">
        <img src="{{ asset('images/hero.png') }}"
             alt="OXXO Al Toque"
             class="w-full h-full object-cover" style="display:block;">

        {{-- Tarjeta flotante sobre la imagen --}}
        <div class="absolute bottom-8 left-8 bg-white rounded-2xl shadow-xl px-5 py-4 flex items-center gap-3">
            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
            <div>
                <p class="text-xs text-gray-400">Disponible ahora</p>
                <p class="text-sm font-semibold text-gray-800">Recoge en minutos</p>
            </div>
        </div>
    </div>

    {{-- Columna derecha: texto --}}
    <div class="flex flex-col justify-center px-20 bg-white">

        {{-- Etiqueta pequeña --}}
        <div class="flex items-center gap-3 mb-6">
            <span class="block w-8 h-0.5 bg-red-600"></span>
            <span class="text-xs font-bold text-red-600 uppercase tracking-widest">OXXO AL TOQUE</span>
        </div>

        {{-- Título principal --}}
        <h1 class="text-7xl font-black text-gray-900 leading-none">OXXO</h1>
        <h2 class="text-7xl font-serif italic text-red-600 leading-none mb-6">Al Toque</h2>

        {{-- Descripción --}}
        <p class="text-gray-500 text-lg mb-8 max-w-sm leading-relaxed">
            Tu tienda de conveniencia en línea. Encuentra tus productos
            favoritos y recoge tu pedido en la sucursal más cercana.
        </p>

        {{-- Botón CTA --}}
        <div>
            <a href="{{ route('catalogo') }}"
               class="inline-block bg-red-600 text-white px-8 py-3 rounded-full font-semibold text-lg hover:bg-red-700 transition">
                Ver productos &rarr;
            </a>
        </div>

    </div>

</section>

{{-- ========== CÓMO FUNCIONA ========== --}}
<section id="como-funciona" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-2 text-gray-800">¿Cómo funciona?</h2>
        <p class="text-gray-400 mb-12">Solo 5 pasos para comprar sin esperas</p>

        <div class="grid grid-cols-5 gap-6">
            @foreach ([
                ['icono' => '🛍️', 'paso' => '1', 'titulo' => 'Explora',          'desc' => 'Navega el catálogo de productos por categoría'],
                ['icono' => '🛒', 'paso' => '2', 'titulo' => 'Arma tu carrito',  'desc' => 'Agrega los productos que quieres comprar'],
                ['icono' => '📍', 'paso' => '3', 'titulo' => 'Elige sucursal',   'desc' => 'Selecciona la tienda OXXO donde recogerás'],
                ['icono' => '✅', 'paso' => '4', 'titulo' => 'Confirma pedido',  'desc' => 'Revisa el resumen y confirma tu orden'],
                ['icono' => '📱', 'paso' => '5', 'titulo' => 'Recoge con QR',    'desc' => 'Muestra tu QR en caja y llévate todo'],
            ] as $paso)

            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center text-3xl mb-4 shadow-md">
                    {{ $paso['icono'] }}
                </div>
                <span class="text-xs font-bold text-red-500 uppercase tracking-wide mb-1">Paso {{ $paso['paso'] }}</span>
                <h3 class="font-semibold text-gray-800 mb-1">{{ $paso['titulo'] }}</h3>
                <p class="text-sm text-gray-400 leading-snug">{{ $paso['desc'] }}</p>
            </div>

            @endforeach
        </div>
    </div>
</section>


@endsection
