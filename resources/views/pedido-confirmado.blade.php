@extends('layouts.public')

@section('contenido')

@php
    // Construir texto que irá dentro del QR
    $lineas = ["OXXO AL TOQUE - PEDIDO: {$referencia}"];
    $lineas[] = "Sucursal: {$sucursal['nombre']}";
    $lineas[] = "----------------------------";
    foreach ($productos as $item) {
        $sub = number_format($item['precio'] * $item['cantidad'], 2);
        $lineas[] = "{$item['nombre']} x{$item['cantidad']} = S/. {$sub}";
    }
    $lineas[] = "----------------------------";
    $lineas[] = "TOTAL: S/. " . number_format($total, 2);
    $lineas[] = "Pago en efectivo en tienda";
    $qrTexto = implode("\n", $lineas);
@endphp

<div class="max-w-lg mx-auto px-6 py-16 text-center">

    {{-- Check --}}
    <div style="width:80px;height:80px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:40px;">
        ✅
    </div>

    <h1 class="text-2xl font-black text-gray-900 mb-1">¡Pedido confirmado!</h1>
    <p class="text-gray-400 mb-8 text-sm">Muestra este QR al cajero de OXXO para retirar tus productos</p>

    {{-- Código de referencia --}}
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-6 py-3 inline-block mb-8">
        <p class="text-xs text-yellow-600 font-medium mb-1">Código de pedido</p>
        <p class="font-black text-xl tracking-widest text-gray-900">{{ $referencia }}</p>
    </div>

    {{-- QR para el cajero --}}
    <div class="bg-white rounded-2xl shadow-md p-8 mb-6 flex flex-col items-center">
        {!! QrCode::size(220)->errorCorrection('M')->generate($qrTexto) !!}
        <p class="text-xs text-gray-400 mt-4">📦 El cajero escanea este QR para verificar tu pedido</p>
    </div>

    {{-- Monto a pagar en caja --}}
    <div style="background:#fef2f2;border:2px solid #fecaca;border-radius:16px;padding:14px 28px;display:inline-block;margin-bottom:28px;">
        <p style="font-size:11px;font-weight:700;color:#dc2626;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:4px;">Monto a pagar en caja</p>
        <p style="font-size:38px;font-weight:900;color:#991b1b;">S/. {{ number_format($total, 2) }}</p>
        <p style="font-size:11px;color:#b91c1c;">Pago en efectivo al momento de recoger</p>
    </div>

    {{-- Detalle de productos --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 text-left mb-8">
        <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide mb-4">🛒 Productos del pedido</h3>
        <div class="space-y-2">
            @foreach($productos as $item)
            <div class="flex justify-between items-center text-sm py-2 border-b border-gray-100">
                <div>
                    <p class="font-semibold text-gray-800">{{ $item['nombre'] }}</p>
                    <p class="text-gray-400 text-xs">{{ $item['cantidad'] }} × S/. {{ number_format($item['precio'], 2) }}</p>
                </div>
                <span class="font-bold text-gray-700">S/. {{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
            </div>
            @endforeach
            <div class="flex justify-between items-center pt-2 font-black text-gray-900">
                <span>Total</span>
                <span>S/. {{ number_format($total, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Sucursal --}}
    <div class="bg-red-50 border border-red-200 rounded-2xl p-5 text-left mb-8">
        <h3 class="font-semibold text-red-700 text-sm uppercase tracking-wide mb-3">📍 Tu sucursal de recojo</h3>
        <p class="font-bold text-gray-900 text-base">{{ $sucursal['nombre'] }}</p>
        <p class="text-sm text-gray-600 mt-1">{{ $sucursal['direccion'] }}</p>
        <p class="text-sm text-gray-500 mt-1">🕐 {{ $sucursal['horario'] }}</p>
    </div>

    {{-- Aviso de vigencia --}}
    <div class="bg-gray-50 rounded-2xl p-6 text-left mb-8">
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="text-red-600 font-bold">⏰</span>
            <p>Tienes <strong>24 horas</strong> para recoger tu pedido, pasado ese tiempo se cancelará automáticamente.</p>
        </div>
    </div>

    <a href="{{ route('catalogo') }}"
       class="inline-block bg-red-600 text-white px-10 py-3 rounded-full font-semibold hover:bg-red-700 transition">
        Seguir comprando
    </a>

</div>

@endsection
