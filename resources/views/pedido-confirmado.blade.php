@extends('layouts.public')

@section('contenido')

@php
    $yapeLink = 'https://app.yape.com.pe/send-money?number=' . $yapePhone
                . '&amount=' . number_format($total, 2)
                . '&concept=OXXO+Al+Toque+' . $referencia;
@endphp

<div class="max-w-lg mx-auto px-6 py-16 text-center">

    {{-- Check --}}
    <div style="width:80px;height:80px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:40px;">
        ✅
    </div>

    <h1 class="text-2xl font-black text-gray-900 mb-1">¡Pedido confirmado!</h1>
    <p class="text-gray-400 mb-8 text-sm">Escanea el QR con Yape para pagar el monto exacto directamente</p>

    {{-- Código --}}
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-6 py-3 inline-block mb-8">
        <p class="text-xs text-yellow-600 font-medium mb-1">Código de pedido</p>
        <p class="font-black text-xl tracking-widest text-gray-900">{{ $referencia }}</p>
    </div>

    {{-- Monto destacado ANTES del QR --}}
    <div style="background:#f5f0fd;border:2px solid #c4b5fd;border-radius:16px;padding:14px 28px;display:inline-block;margin-bottom:20px;">
        <p style="font-size:11px;font-weight:700;color:#7c3aed;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px;">Monto exacto a pagar con Yape</p>
        <p style="font-size:38px;font-weight:900;color:#5b21b6;letter-spacing:1px;">S/. {{ number_format($total, 2) }}</p>
    </div>

    {{-- QR Yape dinámico --}}
    <div class="bg-white rounded-2xl shadow-md p-8 mb-6 inline-block">
        <canvas id="yape-qr" style="display:block;margin:0 auto;border-radius:8px;"></canvas>
        <p class="text-xs text-gray-400 mt-4">📱 Abre Yape → Escanear → apunta aquí</p>
    </div>

    {{-- Botón alternativo: abrir Yape directo --}}
    @if($yapePhone)
    <div style="margin-bottom:28px;">
        <a href="{{ $yapeLink }}"
           style="display:inline-flex;align-items:center;gap:8px;background:#5b21b6;color:#fff;padding:12px 24px;border-radius:12px;font-weight:700;font-size:14px;text-decoration:none;">
            <span style="font-size:20px;">💜</span>
            Pagar S/. {{ number_format($total, 2) }} con Yape
        </a>
        <p class="text-xs text-gray-400 mt-2">Si tienes Yape instalado, este botón abre el pago directo</p>
    </div>
    @endif

    {{-- Sucursal seleccionada --}}
    <div class="bg-red-50 border border-red-200 rounded-2xl p-5 text-left mb-8">
        <h3 class="font-semibold text-red-700 text-sm uppercase tracking-wide mb-3">📍 Tu sucursal de recojo</h3>
        <p class="font-bold text-gray-900 text-base">{{ $sucursal['nombre'] }}</p>
        <p class="text-sm text-gray-600 mt-1">{{ $sucursal['direccion'] }}</p>
        <p class="text-sm text-gray-500 mt-1">🕐 {{ $sucursal['horario'] }}</p>
    </div>

    {{-- Instrucciones --}}
    <div class="bg-gray-50 rounded-2xl p-6 text-left mb-8 space-y-3">
        <h3 class="font-semibold text-gray-700 mb-3 text-sm uppercase tracking-wide">¿Qué sigue?</h3>
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="text-red-600 font-bold">1.</span>
            <p>Escanea el QR con Yape o usa el botón morado para pagar <strong>S/. {{ number_format($total, 2) }}</strong> directamente a nuestra cuenta.</p>
        </div>
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="text-red-600 font-bold">2.</span>
            <p>Dirígete a <strong>{{ $sucursal['nombre'] }}</strong> ({{ $sucursal['distrito'] }}).</p>
        </div>
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="text-red-600 font-bold">3.</span>
            <p>Muestra el código <strong>{{ $referencia }}</strong> al cajero para retirar tus productos.</p>
        </div>
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="text-red-600 font-bold">4.</span>
            <p>Tienes <strong>24 horas</strong> para recoger desde la confirmación.</p>
        </div>
    </div>

    <a href="{{ route('catalogo') }}"
       class="inline-block bg-red-600 text-white px-10 py-3 rounded-full font-semibold hover:bg-red-700 transition">
        Seguir comprando
    </a>

</div>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
(function () {
    const yapeLink = @json($yapeLink);
    const total    = @json(number_format($total, 2));
    const canvas   = document.getElementById('yape-qr');

    QRCode.toCanvas(canvas, yapeLink, {
        width                : 220,
        margin               : 2,
        color                : { dark: '#5b21b6', light: '#ffffff' },
        errorCorrectionLevel : 'H',
    }, function (error) {
        if (error) { console.error(error); return; }
        dibujarLogoYape(canvas, total);
    });

    function dibujarLogoYape(canvas, monto) {
        const ctx = canvas.getContext('2d');
        const cx  = canvas.width  / 2;
        const cy  = canvas.height / 2;

        // Fondo blanco
        ctx.beginPath();
        ctx.arc(cx, cy, 38, 0, 2 * Math.PI);
        ctx.fillStyle = '#ffffff';
        ctx.fill();

        // Círculo morado Yape
        ctx.beginPath();
        ctx.arc(cx, cy - 5, 26, 0, 2 * Math.PI);
        ctx.fillStyle = '#5b21b6';
        ctx.fill();

        // "S/" teal
        ctx.font         = 'bold 14px Arial, sans-serif';
        ctx.fillStyle    = '#14b8a6';
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('S/', cx, cy - 5);

        // "yape" morado abajo
        ctx.font         = 'bold 16px Arial, sans-serif';
        ctx.fillStyle    = '#5b21b6';
        ctx.textBaseline = 'middle';
        ctx.fillText('yape', cx, cy + 24);
    }
})();
</script>

@endsection
