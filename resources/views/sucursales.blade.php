@extends('layouts.public')

@section('contenido')

@php $mapsKey = config('services.google.maps_key'); @endphp

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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Mapa --}}
        <div>
            @if($mapsKey)
                <div id="mapa-oxxo" style="width:100%;height:480px;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.1);"></div>
            @else
                <div style="width:100%;height:480px;border-radius:16px;background:#f3f4f6;display:flex;flex-direction:column;align-items:center;justify-content:center;border:2px dashed #d1d5db;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#9ca3af" viewBox="0 0 24 24" style="margin-bottom:12px;">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <p class="text-gray-500 font-semibold text-sm">Mapa no disponible</p>
                    <p class="text-gray-400 text-xs mt-1">Agrega tu <code class="bg-gray-200 px-1 rounded">GOOGLE_MAPS_KEY</code> en el archivo <code class="bg-gray-200 px-1 rounded">.env</code></p>
                </div>
            @endif
        </div>

        {{-- Lista de sucursales --}}
        <div class="space-y-4" id="lista-sucursales">
            @foreach($sucursales as $id => $s)
            <div id="card-sucursal-{{ $id }}"
                 class="sucursal-card bg-white rounded-2xl shadow hover:shadow-md transition p-4 flex gap-4 cursor-pointer border-2 border-transparent"
                 onclick="seleccionarSucursal({{ $id }})"
                 data-lat="{{ $s['lat'] }}" data-lng="{{ $s['lng'] }}" data-id="{{ $id }}">

                {{-- Ícono tienda OXXO --}}
                <div style="flex-shrink:0;width:72px;height:72px;background:#dc2626;border-radius:12px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 24 24">
                        <path d="M20 4H4v2l8 5 8-5V4zm0 4.24L12 13 4 8.24V20h16V8.24z"/>
                    </svg>
                    <span style="color:white;font-size:8px;font-weight:800;letter-spacing:1px;">OXXO</span>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2 mb-1">
                        <div>
                            <h3 class="font-bold text-gray-800 text-base">{{ $s['nombre'] }}</h3>
                            <p class="text-xs text-red-500 font-semibold">{{ $s['distrito'] }}</p>
                        </div>
                        <span style="background:#dcfce7;color:#16a34a;font-size:10px;font-weight:700;padding:3px 10px;border-radius:999px;white-space:nowrap;flex-shrink:0;">
                            Abierto
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mb-0.5">📍 {{ $s['direccion'] }}</p>
                    <p class="text-sm text-gray-500 mb-0.5">🕐 {{ $s['horario'] }}</p>
                    <p class="text-sm text-gray-500 mb-2">📞 {{ $s['telefono'] }}</p>

                    {{-- Botón directions --}}
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $s['lat'] }},{{ $s['lng'] }}"
                       target="_blank"
                       onclick="event.stopPropagation()"
                       style="display:inline-flex;align-items:center;gap:5px;background:#fef2f2;color:#dc2626;font-size:12px;font-weight:600;padding:5px 12px;border-radius:8px;text-decoration:none;border:1px solid #fecaca;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21.71 11.29l-9-9a1 1 0 0 0-1.42 0l-9 9a1 1 0 0 0 0 1.42l9 9a1 1 0 0 0 1.42 0l9-9a1 1 0 0 0 0-1.42zM14 14.5V12h-4v3H8v-4a1 1 0 0 1 1-1h5V7.5l3.5 3.5-3.5 3.5z"/>
                        </svg>
                        Cómo llegar
                    </a>
                </div>

                {{-- Badge "más cercana" --}}
                <div id="badge-cerca-{{ $id }}" class="hidden" style="position:absolute;top:-8px;right:12px;">
                    <span style="background:#dc2626;color:white;font-size:10px;font-weight:700;padding:3px 10px;border-radius:999px;">
                        Más cercana ★
                    </span>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <p class="text-center text-xs text-gray-400 mt-10">
        ¿No encuentras tu tienda? Escríbenos a <span class="text-red-500 font-medium">contacto@oxxoaltoque.pe</span>
    </p>
</div>

{{-- Datos sucursales para JS --}}
<script>
const SUCURSALES = @json($sucursales);
const MAPS_KEY   = "{{ $mapsKey }}";
let map, markers = {}, infoWindows = {};

@if($mapsKey)
function initMap() {
    const centro = { lat: -12.1100, lng: -77.0210 };
    map = new google.maps.Map(document.getElementById('mapa-oxxo'), {
        center: centro,
        zoom: 12,
        styles: [
            { featureType: 'poi', stylers: [{ visibility: 'off' }] },
            { featureType: 'transit', stylers: [{ visibility: 'off' }] }
        ],
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: true,
    });

    const iconoOxxo = {
        path: 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z',
        fillColor: '#dc2626',
        fillOpacity: 1,
        strokeColor: '#fff',
        strokeWeight: 2,
        scale: 1.8,
        anchor: new google.maps.Point(12, 22),
    };

    Object.entries(SUCURSALES).forEach(([id, s]) => {
        const pos = { lat: s.lat, lng: s.lng };
        const marker = new google.maps.Marker({
            position: pos,
            map,
            title: s.nombre,
            icon: iconoOxxo,
        });

        const iw = new google.maps.InfoWindow({
            content: `
                <div style="padding:8px;min-width:180px;">
                    <p style="font-weight:700;color:#111;margin:0 0 4px;">${s.nombre}</p>
                    <p style="font-size:12px;color:#dc2626;margin:0 0 4px;">${s.distrito}</p>
                    <p style="font-size:12px;color:#555;margin:0 0 2px;">📍 ${s.direccion}</p>
                    <p style="font-size:12px;color:#555;margin:0;">🕐 ${s.horario}</p>
                </div>
            `,
        });

        marker.addListener('click', () => {
            Object.values(infoWindows).forEach(w => w.close());
            iw.open(map, marker);
            resaltarCard(id);
        });

        markers[id] = marker;
        infoWindows[id] = iw;
    });
}
@endif

function seleccionarSucursal(id) {
    document.querySelectorAll('.sucursal-card').forEach(c => {
        c.style.borderColor = 'transparent';
    });
    const card = document.getElementById('card-sucursal-' + id);
    if (card) card.style.borderColor = '#dc2626';

    if (map && markers[id]) {
        map.panTo(markers[id].getPosition());
        map.setZoom(15);
        Object.values(infoWindows).forEach(w => w.close());
        infoWindows[id].open(map, markers[id]);
    }
    card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

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

        // Quitar badges anteriores
        document.querySelectorAll('[id^="badge-cerca-"]').forEach(b => b.classList.add('hidden'));

        if (cercanaid) {
            const badge = document.getElementById('badge-cerca-' + cercanaid);
            if (badge) badge.classList.remove('hidden');
            seleccionarSucursal(cercanaid);
            const distKm = (minDist / 1000).toFixed(1);
            msg.textContent = `Más cercana: ${SUCURSALES[cercanaid].nombre} (${distKm} km)`;
        }

        if (map) {
            new google.maps.Marker({
                position: { lat: uLat, lng: uLng },
                map,
                title: 'Tu ubicación',
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 8,
                    fillColor: '#1d4ed8',
                    fillOpacity: 1,
                    strokeColor: '#fff',
                    strokeWeight: 2,
                },
                zIndex: 10,
            });
            map.panTo({ lat: uLat, lng: uLng });
            map.setZoom(13);
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

@if($mapsKey)
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ $mapsKey }}&callback=initMap&loading=async"
    async defer>
</script>
@endif

<style>
.sucursal-card { position: relative; }
.sucursal-card:hover { border-color: #fca5a5 !important; }
</style>

@endsection
