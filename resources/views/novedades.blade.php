@extends('layouts.public')

@section('contenido')
<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Encabezado --}}
    <div class="mb-8">
        <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Recién llegados</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-1">Novedades</h1>
        <p class="text-gray-400 mt-1">Los productos más nuevos disponibles en tu OXXO</p>
    </div>

    {{-- Banner --}}
    <div style="background:linear-gradient(135deg,#1f2937,#374151);border-radius:20px;padding:32px 40px;margin-bottom:40px;display:flex;align-items:center;justify-content:space-between;">
        <div>
            <p style="color:rgba(255,255,255,0.6);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:2px;">Junio 2026</p>
            <h2 style="color:white;font-size:28px;font-weight:900;margin:6px 0;">Nuevos productos este mes</h2>
            <p style="color:rgba(255,255,255,0.7);font-size:14px;">Descubre las últimas incorporaciones al catálogo OXXO</p>
        </div>
        <div style="font-size:72px;">✨</div>
    </div>

    {{-- Grid de novedades --}}
    <div class="grid grid-cols-4 gap-6">

        {{-- Producto 1 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#16a34a;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">NUEVO</span>
            <div class="w-full h-48 bg-pink-50 flex items-center justify-center text-6xl">🧃</div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Bebidas</span>
                <h3 class="font-semibold text-gray-800 mt-1">Sporade Maracuyá 500ml</h3>
                <p class="text-xs text-gray-400 mt-1">Edición especial sabor tropical</p>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 2.50</span>
                    <span style="background:#dcfce7;color:#16a34a;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;">Disponible</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 2 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#16a34a;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">NUEVO</span>
            <div class="w-full h-48 bg-yellow-50 flex items-center justify-center text-6xl">🥐</div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Panadería</span>
                <h3 class="font-semibold text-gray-800 mt-1">Croissant de Mantequilla</h3>
                <p class="text-xs text-gray-400 mt-1">Recién horneado cada mañana</p>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 3.00</span>
                    <span style="background:#dcfce7;color:#16a34a;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;">Disponible</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 3 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#16a34a;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">NUEVO</span>
            <div class="w-full h-48 bg-indigo-50 flex items-center justify-center text-6xl">🧴</div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Higiene</span>
                <h3 class="font-semibold text-gray-800 mt-1">Desodorante Rexona 150ml</h3>
                <p class="text-xs text-gray-400 mt-1">Protección 48 horas</p>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 9.50</span>
                    <span style="background:#dcfce7;color:#16a34a;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;">Disponible</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 4 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#16a34a;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">NUEVO</span>
            <div class="w-full h-48 bg-orange-50 flex items-center justify-center text-6xl">🍫</div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Snacks</span>
                <h3 class="font-semibold text-gray-800 mt-1">Queque Marmoleado 90g</h3>
                <p class="text-xs text-gray-400 mt-1">Sabor casero en cada bocado</p>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 2.50</span>
                    <span style="background:#dcfce7;color:#16a34a;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;">Disponible</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 5 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#16a34a;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">NUEVO</span>
            <div class="w-full h-48 bg-teal-50 flex items-center justify-center text-6xl">🧀</div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Lácteos</span>
                <h3 class="font-semibold text-gray-800 mt-1">Queso Fresco Laive 250g</h3>
                <p class="text-xs text-gray-400 mt-1">100% leche fresca nacional</p>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 7.90</span>
                    <span style="background:#dcfce7;color:#16a34a;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;">Disponible</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 6 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#16a34a;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">NUEVO</span>
            <div class="w-full h-48 bg-sky-50 flex items-center justify-center text-6xl">🫙</div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Limpieza</span>
                <h3 class="font-semibold text-gray-800 mt-1">Limpiatodo Sapolio 500ml</h3>
                <p class="text-xs text-gray-400 mt-1">Fórmula antibacterial nueva</p>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 5.50</span>
                    <span style="background:#dcfce7;color:#16a34a;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;">Disponible</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
