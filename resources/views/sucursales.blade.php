@extends('layouts.public')

@section('contenido')
<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Puntos de recojo</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-1">Sucursales OXXO</h1>
        <p class="text-gray-400 mt-1">Encuentra la tienda más cercana y recoge tu pedido</p>
    </div>

    {{-- Buscador ya no decorativo pe --}}
    <div class="bg-white rounded-2xl shadow p-4 flex gap-3 mb-10 max-w-xl">
        <input type="text" id="buscarSucursal" placeholder="Buscar por distrito o dirección..."
               class="flex-1 text-sm text-gray-700 outline-none px-2">
        <button type="button" id="btnBuscarSucursal"style="background:#dc2626;color:white;padding:8px 20px;border-radius:8px;font-size:14px;font-weight:600;border:none;cursor:pointer;">
            Buscar
        </button>
    </div>

    {{-- Grid de sucursales --}}
    <div class="grid grid-cols-3 gap-6">

        @forelse ($sucursales as $sucursal)
            @php
                $estadoColor = match ($sucursal->estado) {
                    'Abierto' => 'background:#dcfce7;color:#16a34a;',
                    'Cerrado' => 'background:#fee2e2;color:#dc2626;',
                    default => 'background:#fef9c3;color:#ca8a04;',
                };
            @endphp

            <div class="sucursal-card bg-white rounded-2xl shadow hover:shadow-md transition p-6"data-busqueda="{{ strtolower($sucursal->nombre . ' ' . $sucursal->distrito . ' ' . $sucursal->direccion) }}">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $sucursal->nombre }}</h3>
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $sucursal->distrito }}</p>
                    </div>

                    <span style="{{ $estadoColor }}font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;">
                        {{ $sucursal->estado }}
                    </span>
                </div>

                <p class="text-sm text-gray-500 mb-1">Direccion: {{ $sucursal->direccion }}</p>
                <p class="text-sm text-gray-500 mb-1">Horario: {{ $sucursal->horario }}</p>
                <p class="text-sm text-gray-500">Telefono: {{ $sucursal->telefono ?? '-' }}</p>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-2xl shadow p-8 text-center text-gray-400">
                No hay sucursales registradas aun.
            </div>
        @endforelse

    </div>

    {{-- Nota --}}
    <p class="text-center text-xs text-gray-400 mt-10">
        ¿No encuentras tu tienda? Escríbenos a <span class="text-red-500 font-medium">contacto@oxxoaltoque.pe</span>
    </p>

</div>
<script>
    const inputBuscar = document.getElementById('buscarSucursal');
    const btnBuscar = document.getElementById('btnBuscarSucursal');
    const sucursales = document.querySelectorAll('.sucursal-card');

    function filtrarSucursales() {
        const texto = inputBuscar.value.toLowerCase().trim();

        sucursales.forEach(function (card) {
            const datos = card.getAttribute('data-busqueda');

            if (datos.includes(texto)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    btnBuscar.addEventListener('click', filtrarSucursales);

    inputBuscar.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            filtrarSucursales();
        }
    });
</script>
@endsection
