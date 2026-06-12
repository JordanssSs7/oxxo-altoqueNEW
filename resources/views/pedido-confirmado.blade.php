@extends('layouts.public')

@section('contenido')
<div class="max-w-lg mx-auto px-6 py-16 text-center">

    {{-- Check --}}
    <div style="width:80px;height:80px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:40px;">
        ✅
    </div>

    <h1 class="text-2xl font-black text-gray-900 mb-1">¡Pedido confirmado!</h1>
    <p class="text-gray-400 mb-8 text-sm">Presenta este QR en caja al momento de recoger tu pedido</p>

    {{-- Código --}}
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-6 py-3 inline-block mb-8">
        <p class="text-xs text-yellow-600 font-medium mb-1">Código de pedido</p>
        <p class="font-black text-xl tracking-widest text-gray-900">OXT-A1B2C3D4</p>
    </div>

    {{-- QR estático --}}
    <div class="bg-white rounded-2xl shadow-md p-8 mb-8 inline-block">
        <img src="{{ asset('images/qr-ejemplo.jpeg') }}"
             alt="Código QR del pedido"
             class="w-48 h-48 mx-auto block">
        <p class="text-xs text-gray-400 mt-4">Escanea en caja OXXO</p>
    </div>

    {{-- Instrucciones --}}
    <div class="bg-gray-50 rounded-2xl p-6 text-left mb-8 space-y-3">
        <h3 class="font-semibold text-gray-700 mb-3 text-sm uppercase tracking-wide">¿Qué sigue?</h3>
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="text-red-600 font-bold">1.</span>
            <p>Dirígete a la tienda OXXO más cercana.</p>
        </div>
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="text-red-600 font-bold">2.</span>
            <p>Muestra este QR al cajero para identificar tu pedido.</p>
        </div>
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="text-red-600 font-bold">3.</span>
            <p>Realiza el pago en caja y recibe tus productos.</p>
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
@endsection
