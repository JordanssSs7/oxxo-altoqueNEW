@extends('layouts.public')

@section('contenido')
<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Encabezado --}}
    <div class="mb-8">
        <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Ofertas especiales</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-1">Promociones</h1>
        <p class="text-gray-400 mt-1">Aprovecha los mejores precios en tu OXXO más cercano</p>
    </div>

    {{-- Banner --}}
    <div style="background:linear-gradient(135deg,#dc2626,#991b1b);border-radius:20px;padding:32px 40px;margin-bottom:40px;display:flex;align-items:center;justify-content:space-between;">
        <div>
            <p style="color:rgba(255,255,255,0.75);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:2px;">Oferta del día</p>
            <h2 style="color:white;font-size:28px;font-weight:900;margin:6px 0;">Hasta 30% de descuento</h2>
            <p style="color:rgba(255,255,255,0.8);font-size:14px;">En bebidas, snacks y lácteos seleccionados</p>
        </div>
        <div style="font-size:72px;"></div>
    </div>

    {{-- Grid de productos en oferta --}}
    <div class="grid grid-cols-4 gap-6">

        {{-- Producto 1 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#dc2626;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">-20%</span>
            <div class="w-full h-48 bg-gray-100"></div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Bebidas</span>
                <h3 class="font-semibold text-gray-800 mt-1">Gaseosa Inca Kola 500ml</h3>
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 2.24</span>
                    <span class="text-sm text-gray-400 line-through">S/. 2.80</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 2 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#dc2626;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">-15%</span>
            <div class="w-full h-48 bg-gray-100"></div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Snacks</span>
                <h3 class="font-semibold text-gray-800 mt-1">Papas Lays Clásicas 38g</h3>
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 1.70</span>
                    <span class="text-sm text-gray-400 line-through">S/. 2.00</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 3 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#dc2626;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">-25%</span>
            <div class="w-full h-48 bg-gray-100"></div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Lácteos</span>
                <h3 class="font-semibold text-gray-800 mt-1">Leche Gloria Entera 1L</h3>
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 3.90</span>
                    <span class="text-sm text-gray-400 line-through">S/. 5.20</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 4 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#dc2626;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">-10%</span>
            <div class="w-full h-48 bg-gray-100"></div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Higiene</span>
                <h3 class="font-semibold text-gray-800 mt-1">Jabón Dove Original 90g</h3>
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 3.15</span>
                    <span class="text-sm text-gray-400 line-through">S/. 3.50</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 5 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#dc2626;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">-30%</span>
            <div class="w-full h-48 bg-gray-100"></div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Snacks</span>
                <h3 class="font-semibold text-gray-800 mt-1">Galletas Oreo 6 unidades</h3>
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 1.26</span>
                    <span class="text-sm text-gray-400 line-through">S/. 1.80</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 6 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#dc2626;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">-18%</span>
            <div class="w-full h-48 bg-gray-100"></div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Higiene</span>
                <h3 class="font-semibold text-gray-800 mt-1">Champú Head & Shoulders 200ml</h3>
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 7.30</span>
                    <span class="text-sm text-gray-400 line-through">S/. 8.90</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 7 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#dc2626;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">-12%</span>
            <div class="w-full h-48 bg-gray-100"></div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Bebidas</span>
                <h3 class="font-semibold text-gray-800 mt-1">Agua San Luis 625ml</h3>
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 1.32</span>
                    <span class="text-sm text-gray-400 line-through">S/. 1.50</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

        {{-- Producto 8 --}}
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden relative">
            <span style="position:absolute;top:12px;left:12px;background:#dc2626;color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">-22%</span>
            <div class="w-full h-48 bg-gray-100"></div>
            <div class="p-4">
                <span class="text-xs text-red-500 font-semibold uppercase">Limpieza</span>
                <h3 class="font-semibold text-gray-800 mt-1">Lejía Clorox 500ml</h3>
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-lg font-black text-gray-900">S/. 3.28</span>
                    <span class="text-sm text-gray-400 line-through">S/. 4.20</span>
                </div>
                <a href="{{ route('catalogo') }}" style="display:block;width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;text-decoration:none;font-size:14px;">
                    Ver en catálogo
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
