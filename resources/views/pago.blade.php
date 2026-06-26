@extends('layouts.public')

@section('contenido')

{{-- Header OXXO Pay --}}
<div style="background:#dc2626;padding:20px 0;">
    <div class="max-w-4xl mx-auto px-6 flex items-center gap-4">
        <img src="{{ asset('images/logo-oxxo.png') }}" alt="OXXO" style="height:36px;filter:brightness(0) invert(1);">
        <div>
            <span style="color:white;font-size:22px;font-weight:800;letter-spacing:-0.5px;">Pay</span>
            <p style="color:rgba(255,255,255,0.75);font-size:12px;margin:0;">Pasarela de pago segura</p>
        </div>
        <div style="margin-left:auto;">
            <span style="background:rgba(255,255,255,0.15);color:white;font-size:12px;padding:4px 12px;border-radius:999px;font-weight:600;">
                🔒 Pago seguro
            </span>
        </div>
    </div>
</div>

<form action="{{ route('carrito.confirmar') }}" method="POST">
@csrf
<div class="max-w-4xl mx-auto px-6 py-10">

    {{-- Referencia --}}
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-5 py-3 mb-8 flex items-center gap-3">
        <span class="text-yellow-500 text-xl">📋</span>
        <div>
            <p class="text-xs text-yellow-600 font-medium">Código de referencia</p>
            <p class="font-bold text-gray-800 tracking-widest text-lg">{{ $referencia }}</p>
        </div>
    </div>

    @if($errors->has('sucursal_id'))
        <div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;border-radius:12px;padding:12px 20px;margin-bottom:24px;font-size:14px;font-weight:600;">
            ⚠️ {{ $errors->first('sucursal_id') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-8">

        {{-- Columna izquierda --}}
        <div class="space-y-8">

            {{-- Detalle del pedido --}}
            <div>
                <h2 class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-4">Detalle del pedido</h2>
                <div class="space-y-3">
                    @foreach($carrito as $item)
                    <div class="flex justify-between items-center bg-white rounded-xl shadow-sm px-4 py-3 text-sm">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item['nombre'] }}</p>
                            <p class="text-gray-400">{{ $item['cantidad'] }} × S/. {{ number_format($item['precio'], 2) }}</p>
                        </div>
                        <span class="font-semibold text-gray-700">S/. {{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Selector de sucursal --}}
            <div>
                <h2 class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-4">Elige tu sucursal de recojo</h2>
                <div class="space-y-3">
                    @foreach($sucursales as $id => $s)
                    <label class="radio-label block cursor-pointer" for="suc-{{ $id }}">
                        <input type="radio" name="sucursal_id" id="suc-{{ $id }}" value="{{ $id }}"
                               class="radio-input" {{ $loop->first ? 'checked' : '' }}>
                        <div class="radio-card flex items-center gap-3 bg-white rounded-xl shadow-sm px-4 py-3 border-2">

                            {{-- Ícono tienda --}}
                            <div style="flex-shrink:0;width:52px;height:52px;background:#dc2626;border-radius:10px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white" viewBox="0 0 24 24">
                                    <path d="M2 7h20v2H2zm1 3h18v11H3V10zm4 2v7h2v-7H7zm4 0v7h2v-7h-2zm4 0v7h2v-7h-2zM1 3h22v4H1z"/>
                                </svg>
                                <span style="color:white;font-size:7px;font-weight:800;letter-spacing:.5px;">OXXO</span>
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-sm text-gray-800">{{ $s['nombre'] }}</p>
                                <p class="text-xs text-red-500 font-medium">{{ $s['distrito'] }}</p>
                                <p class="text-xs text-gray-500">📍 {{ $s['direccion'] }}</p>
                                <p class="text-xs text-gray-400">🕐 {{ $s['horario'] }}</p>
                            </div>

                            {{-- Indicador selección --}}
                            <div class="radio-dot" style="flex-shrink:0;width:18px;height:18px;border-radius:50%;border:2px solid #d1d5db;display:flex;align-items:center;justify-content:center;">
                                <div class="radio-dot-inner" style="width:8px;height:8px;border-radius:50%;background:#dc2626;display:none;"></div>
                            </div>

                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Panel de pago --}}
        <div>
            <div class="bg-white rounded-2xl shadow p-6" style="position:sticky;top:90px;">
                <h2 class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-4">Monto a pagar</h2>

                <div class="text-4xl font-black text-gray-900 mb-1">S/. {{ number_format($total, 2) }}</div>
                <p class="text-xs text-gray-400 mb-6">Incluye IGV. Pago en efectivo en tienda.</p>

                {{-- Método --}}
                <div class="border border-gray-200 rounded-xl p-4 mb-6 flex items-center gap-3">
                    <div style="background:#dc2626;width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-size:18px;">
                        🏪
                    </div>
                    <div>
                        <p class="font-semibold text-sm text-gray-800">Pago en tienda OXXO</p>
                        <p class="text-xs text-gray-400">Recoge y paga en caja</p>
                    </div>
                    <span style="margin-left:auto;background:#dcfce7;color:#16a34a;font-size:11px;font-weight:700;padding:2px 10px;border-radius:999px;">
                        Seleccionado
                    </span>
                </div>

                {{-- Confirmar --}}
                <button type="submit"
                        style="display:block;width:100%;text-align:center;background:#dc2626;color:white;padding:14px 0;border-radius:12px;font-weight:700;font-size:16px;border:none;cursor:pointer;transition:background .2s;"
                        onmouseover="this.style.background='#b91c1c'"
                        onmouseout="this.style.background='#dc2626'">
                    Confirmar y generar QR →
                </button>

                <p class="text-center text-xs text-gray-400 mt-3">
                    Al confirmar aceptas los <a href="{{ route('terminos') }}" class="underline hover:text-red-600">términos y condiciones</a>
                </p>
            </div>

            <a href="{{ route('carrito.index') }}" class="block text-center text-sm text-gray-400 hover:text-red-600 mt-4 transition">
                ← Volver al carrito
            </a>
        </div>

    </div>
</div>
</form>

<style>
.radio-card {
    border-color: #e5e7eb;
    transition: border-color .15s, background .15s;
}
.radio-input:checked ~ .radio-card {
    border-color: #dc2626;
    background-color: #fef2f2;
}
.radio-input:checked ~ .radio-card .radio-dot {
    border-color: #dc2626;
}
.radio-input:checked ~ .radio-card .radio-dot-inner {
    display: block;
}
.radio-input { display: none; }
.radio-label:hover .radio-card {
    border-color: #fca5a5;
}
</style>

@endsection
