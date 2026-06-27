@extends('layouts.public')

@section('contenido')

<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Encabezado --}}
    <div class="mb-8">
        <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Puntos de recojo</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-1">Sucursales OXXO</h1>
        <p class="text-gray-400 mt-1">Encuentra la tienda más cercana y recoge tu pedido</p>
    </div>

    {{-- Botón ubicación --}}
    <div class="flex flex-wrap items-center gap-3 mb-8">
        <button id="btn-cerca"
            onclick="encontrarMasCercana()"
            style="background:#dc2626;color:white;padding:10px 22px;border-radius:10px;font-size:14px;font-weight:700;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
            Encontrar sucursal más cercana
        </button>
        <span id="msg-cerca" class="text-sm text-gray-500 hidden"></span>
    </div>

    {{-- Grid de sucursales --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="lista-sucursales">
        @foreach($sucursales as $id => $s)
        <div id="card-sucursal-{{ $id }}"
             class="sucursal-card bg-white rounded-2xl shadow hover:shadow-md transition p-4 flex gap-4 border-2 border-transparent"
             data-lat="{{ $s['lat'] }}" data-lng="{{ $s['lng'] }}" data-id="{{ $id }}">

            {{-- Ícono tienda OXXO --}}
            <div style="flex-shrink:0;width:60px;height:60px;background:#dc2626;border-radius:12px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
                    <path d="M2 7h20v2H2zm1 3h18v11H3V10zm4 2v7h2v-7H7zm4 0v7h2v-7h-2zm4 0v7h2v-7h-2zM1 3h22v4H1z"/>
                </svg>
                <span style="color:white;font-size:7px;font-weight:800;letter-spacing:.5px;">OXXO</span>
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2 mb-1">
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">{{ $s['nombre'] }}</h3>
                        <p class="text-xs text-red-500 font-semibold">{{ $s['distrito'] }}</p>
                    </div>
                    <div id="badge-cerca-{{ $id }}" class="hidden" style="flex-shrink:0;">
                        <span style="background:#dc2626;color:white;font-size:9px;font-weight:700;padding:2px 8px;border-radius:999px;white-space:nowrap;">
                            Más cercana ★
                        </span>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mb-0.5">📍 {{ $s['direccion'] }}</p>
                <p class="text-xs text-gray-500 mb-0.5">🕐 {{ $s['horario'] }}</p>
                <p class="text-xs text-gray-500 mb-2">📞 {{ $s['telefono'] }}</p>

                <div class="flex items-center gap-2">
                    <span style="background:#dcfce7;color:#16a34a;font-size:9px;font-weight:700;padding:2px 8px;border-radius:999px;">
                        Abierto
                    </span>
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $s['lat'] }},{{ $s['lng'] }}"
                       target="_blank"
                       style="display:inline-flex;align-items:center;gap:4px;background:#fef2f2;color:#dc2626;font-size:11px;font-weight:600;padding:3px 10px;border-radius:8px;text-decoration:none;border:1px solid #fecaca;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21.71 11.29l-9-9a1 1 0 0 0-1.42 0l-9 9a1 1 0 0 0 0 1.42l9 9a1 1 0 0 0 1.42 0l9-9a1 1 0 0 0 0-1.42zM14 14.5V12h-4v3H8v-4a1 1 0 0 1 1-1h5V7.5l3.5 3.5-3.5 3.5z"/>
                        </svg>
                        Cómo llegar
                    </a>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    <p class="text-center text-xs text-gray-400 mt-10">
        ¿No encuentras tu tienda? Escríbenos a <span class="text-red-500 font-medium">contacto@oxxoaltoque.pe</span>
    </p>
</div>

<script>
const SUCURSALES = @json($sucursales);

function encontrarMasCercana() {
    const btn = document.getElementById('btn-cerca');
    const msg = document.getElementById('msg-cerca');
    btn.disabled = true;
    btn.style.opacity = '.7';
    msg.textContent = 'Obteniendo tu ubicación...';
    msg.classList.remove('hidden');

    if (!navigator.geolocation) {
        msg.textContent = 'Tu navegador no soporta geolocalización.';
        btn.disabled = false;
        btn.style.opacity = '1';
        return;
    }

    navigator.geolocation.getCurrentPosition(pos => {
        const uLat = pos.coords.latitude;
        const uLng = pos.coords.longitude;

        let minDist = Infinity, cercanaid = null;
        Object.entries(SUCURSALES).forEach(([id, s]) => {
            const d = haversine(uLat, uLng, s.lat, s.lng);
            if (d < minDist) { minDist = d; cercanaid = id; }
        });

        document.querySelectorAll('[id^="badge-cerca-"]').forEach(b => b.classList.add('hidden'));
        document.querySelectorAll('.sucursal-card').forEach(c => c.style.borderColor = 'transparent');

        if (cercanaid) {
            document.getElementById('badge-cerca-' + cercanaid)?.classList.remove('hidden');
            document.getElementById('card-sucursal-' + cercanaid).style.borderColor = '#dc2626';
            document.getElementById('card-sucursal-' + cercanaid).scrollIntoView({ behavior: 'smooth', block: 'center' });
            const distKm = (minDist / 1000).toFixed(1);
            msg.textContent = `Más cercana: ${SUCURSALES[cercanaid].nombre} (${distKm} km)`;
        }

        btn.disabled = false;
        btn.style.opacity = '1';
    }, () => {
        msg.textContent = 'No se pudo obtener tu ubicación.';
        btn.disabled = false;
        btn.style.opacity = '1';
    });
}

function haversine(lat1, lng1, lat2, lng2) {
    const R = 6371000;
    const φ1 = lat1 * Math.PI / 180, φ2 = lat2 * Math.PI / 180;
    const Δφ = (lat2 - lat1) * Math.PI / 180;
    const Δλ = (lng2 - lng1) * Math.PI / 180;
    const a = Math.sin(Δφ/2)**2 + Math.cos(φ1)*Math.cos(φ2)*Math.sin(Δλ/2)**2;
    return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
}
</script>

<style>
.sucursal-card:hover { border-color: #fca5a5 !important; }
</style>

@endsection
