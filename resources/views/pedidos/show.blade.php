@extends('layouts.public')

@section('contenido')

<div class="max-w-2xl mx-auto px-6 py-12">

    <a href="{{ route('pedidos.index') }}" class="text-sm text-gray-400 hover:text-red-600 transition mb-6 inline-block">
        ← Volver a mis pedidos
    </a>

    <h1 class="text-2xl font-black text-gray-900 mb-6">Detalle del pedido</h1>

    {{-- Referencia y estado --}}
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-5 py-4 mb-6 flex items-center justify-between">
        <div>
            <p class="text-xs text-yellow-600 font-medium">Código de referencia</p>
            <p class="font-black text-gray-900 tracking-widest text-lg">{{ $pedido->referencia }}</p>
        </div>
        @php
            $color = match($pedido->estado) {
                'Pendiente'  => ['bg' => '#fef9c3', 'text' => '#854d0e'],
                'Completado' => ['bg' => '#dcfce7', 'text' => '#166534'],
                'Cancelado'  => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                default      => ['bg' => '#f3f4f6', 'text' => '#374151'],
            };
        @endphp
        <span style="background:{{ $color['bg'] }};color:{{ $color['text'] }};padding:6px 16px;border-radius:999px;font-size:13px;font-weight:700;">
            {{ $pedido->estado }}
        </span>
    </div>

    {{-- Sucursal --}}
    <div class="bg-red-50 border border-red-200 rounded-2xl p-5 mb-6">
        <h3 class="font-semibold text-red-700 text-xs uppercase tracking-wide mb-2">📍 Sucursal de recojo</h3>
        <p class="font-bold text-gray-900">{{ $pedido->sucursal->nombre ?? 'Sin sucursal' }}</p>
        <p class="text-sm text-gray-600 mt-1">{{ $pedido->sucursal->direccion ?? '-' }}</p>
        <p class="text-xs text-gray-400 mt-1">📅 {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
    </div>

    {{-- Productos --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
        <h3 class="font-semibold text-gray-700 text-xs uppercase tracking-wide mb-4">🛒 Productos</h3>
        <div class="space-y-3">
            @foreach($pedido->detalles as $detalle)
            <div class="flex justify-between items-center text-sm py-2 border-b border-gray-100">
                <div>
                    <p class="font-semibold text-gray-800">{{ $detalle->nombre_producto }}</p>
                    <p class="text-gray-400 text-xs">{{ $detalle->cantidad }} × S/ {{ number_format($detalle->precio, 2) }}</p>
                </div>
                <span class="font-bold text-gray-700">S/ {{ number_format($detalle->subtotal, 2) }}</span>
            </div>
            @endforeach
            <div class="flex justify-between items-center pt-2 font-black text-gray-900 text-base">
                <span>Total</span>
                <span>S/ {{ number_format($pedido->total, 2) }}</span>
            </div>
        </div>
    </div>

</div>

@endsection