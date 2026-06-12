@extends('layouts.public')

@section('contenido')
<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Puntos de recojo</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-1">Sucursales OXXO</h1>
        <p class="text-gray-400 mt-1">Encuentra la tienda más cercana y recoge tu pedido</p>
    </div>

    {{-- Buscador decorativo --}}
    <div class="bg-white rounded-2xl shadow p-4 flex gap-3 mb-10 max-w-xl">
        <input type="text" placeholder="Buscar por distrito o dirección..."
               class="flex-1 text-sm text-gray-700 outline-none px-2"
               disabled>
        <button style="background:#dc2626;color:white;padding:8px 20px;border-radius:8px;font-size:14px;font-weight:600;border:none;cursor:not-allowed;opacity:.7;">
            Buscar
        </button>
    </div>

    {{-- Grid de sucursales --}}
    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow hover:shadow-md transition p-6">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <h3 class="font-bold text-gray-800">OXXO Miraflores</h3>
                    <p class="text-xs text-red-500 font-semibold mt-1">Miraflores, Lima</p>
                </div>
                <span style="background:#dcfce7;color:#16a34a;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">Abierto</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">📍 Av. Larco 345, Miraflores</p>
            <p class="text-sm text-gray-500 mb-1">🕐 Lun–Dom: 7:00 am – 11:00 pm</p>
            <p class="text-sm text-gray-500">📞 (01) 234-5678</p>
        </div>

        <div class="bg-white rounded-2xl shadow hover:shadow-md transition p-6">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <h3 class="font-bold text-gray-800">OXXO San Isidro</h3>
                    <p class="text-xs text-red-500 font-semibold mt-1">San Isidro, Lima</p>
                </div>
                <span style="background:#dcfce7;color:#16a34a;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">Abierto</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">📍 Calle Los Libertadores 120, San Isidro</p>
            <p class="text-sm text-gray-500 mb-1">🕐 Lun–Dom: 6:30 am – 11:30 pm</p>
            <p class="text-sm text-gray-500">📞 (01) 345-6789</p>
        </div>

        <div class="bg-white rounded-2xl shadow hover:shadow-md transition p-6">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <h3 class="font-bold text-gray-800">OXXO Surco</h3>
                    <p class="text-xs text-red-500 font-semibold mt-1">Santiago de Surco, Lima</p>
                </div>
                <span style="background:#dcfce7;color:#16a34a;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">Abierto</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">📍 Av. Primavera 890, Surco</p>
            <p class="text-sm text-gray-500 mb-1">🕐 Lun–Dom: 7:00 am – 12:00 am</p>
            <p class="text-sm text-gray-500">📞 (01) 456-7890</p>
        </div>

        <div class="bg-white rounded-2xl shadow hover:shadow-md transition p-6">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <h3 class="font-bold text-gray-800">OXXO Barranco</h3>
                    <p class="text-xs text-red-500 font-semibold mt-1">Barranco, Lima</p>
                </div>
                <span style="background:#dcfce7;color:#16a34a;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">Abierto</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">📍 Av. Grau 210, Barranco</p>
            <p class="text-sm text-gray-500 mb-1">🕐 Lun–Dom: 8:00 am – 10:00 pm</p>
            <p class="text-sm text-gray-500">📞 (01) 567-8901</p>
        </div>

        <div class="bg-white rounded-2xl shadow hover:shadow-md transition p-6">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <h3 class="font-bold text-gray-800">OXXO San Borja</h3>
                    <p class="text-xs text-red-500 font-semibond mt-1">San Borja, Lima</p>
                </div>
                <span style="background:#dcfce7;color:#16a34a;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">Abierto</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">📍 Av. San Luis 1850, San Borja</p>
            <p class="text-sm text-gray-500 mb-1">🕐 Lun–Dom: 7:00 am – 11:00 pm</p>
            <p class="text-sm text-gray-500">📞 (01) 678-9012</p>
        </div>

        <div class="bg-white rounded-2xl shadow hover:shadow-md transition p-6">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <h3 class="font-bold text-gray-800">OXXO La Molina</h3>
                    <p class="text-xs text-red-500 font-semibold mt-1">La Molina, Lima</p>
                </div>
                <span style="background:#fef9c3;color:#ca8a04;font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">Próximamente</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">📍 Av. La Molina 560, La Molina</p>
            <p class="text-sm text-gray-500 mb-1">🕐 Lun–Dom: 7:00 am – 11:00 pm</p>
            <p class="text-sm text-gray-500">📞 —</p>
        </div>

    </div>

    {{-- Nota --}}
    <p class="text-center text-xs text-gray-400 mt-10">
        ¿No encuentras tu tienda? Escríbenos a <span class="text-red-500 font-medium">contacto@oxxoaltoque.pe</span>
    </p>

</div>
@endsection
