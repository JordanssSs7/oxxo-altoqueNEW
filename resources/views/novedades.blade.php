@extends('layouts.public')

@section('contenido')
<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Recién llegados</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-1">Novedades</h1>
        <p class="text-gray-400 mt-1">Los productos más nuevos disponibles en tu OXXO</p>
    </div>

    <div style="background:linear-gradient(135deg,#1f2937,#374151);border-radius:20px;padding:32px 40px;margin-bottom:40px;">
        <p style="color:rgba(255,255,255,0.6);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:2px;">Junio 2026</p>
        <h2 style="color:white;font-size:28px;font-weight:900;margin:6px 0;">Nuevos productos este mes</h2>
        <p style="color:rgba(255,255,255,0.7);font-size:14px;">Descubre las últimas incorporaciones al catálogo OXXO</p>
    </div>

    <div class="grid grid-cols-4 gap-6">
        @forelse($productos as $producto)
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">

            <span style="position:absolute;top:12px;left:12px;background:#16a34a;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;z-index:10;">
                NUEVO
            </span>

            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}"
                     alt="{{ $producto->nombre }}"
                     class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-100"></div>
            @endif

            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase tracking-wide">
                    {{ $producto->categoria->nombre }}
                </span>
                <h3 class="font-semibold text-gray-800 mt-1">{{ $producto->nombre }}</h3>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-lg font-black text-gray-900">S/. {{ number_format($producto->precio, 2) }}</span>
                    <span style="background:#dcfce7;color:#16a34a;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;">Disponible</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center text-gray-400 py-16">
            <p class="text-lg">No hay novedades disponibles aún.</p>
        </div>
        @endforelse
    </div>

</div>
@endsection
