@extends('layouts.public')

@section('contenido')

<div class="max-w-4xl mx-auto px-6 py-12">

    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900">Mis pedidos</h1>
        <p class="text-gray-400 mt-1 text-sm">Historial de tus compras en OXXO Al Toque</p>
    </div>

    @if($pedidos->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
            <div style="font-size:56px;margin-bottom:16px;">🛍️</div>
            <h2 class="text-xl font-bold text-gray-700 mb-2">Aún no tienes pedidos</h2>
            <p class="text-gray-400 text-sm mb-6">Cuando realices una compra, aparecerá aquí.</p>
            <a href="{{ route('catalogo') }}"
               style="background:#dc2626;color:white;padding:12px 28px;border-radius:999px;font-weight:700;font-size:14px;text-decoration:none;">
                Ir a comprar
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($pedidos as $pedido)
            <div class="bg-white rounded-2xl shadow-sm px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div class="flex items-center gap-4">
                    <div style="width:48px;height:48px;background:#fef2f2;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0;">
                        🛒
                    </div>
                    <div>
                        <p class="font-black text-gray-900 tracking-widest text-sm">{{ $pedido->referencia }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="text-sm text-gray-600">
                    <p class="font-semibold text-gray-800">{{ $pedido->sucursal->nombre ?? 'Sin sucursal' }}</p>
                    <p class="text-xs text-gray-400">📍 {{ $pedido->sucursal->distrito ?? '' }}</p>
                </div>

                <div class="text-center">
                    <p class="text-xl font-black text-gray-900">S/ {{ number_format($pedido->total, 2) }}</p>
                    <p class="text-xs text-gray-400">Total</p>
                </div>

                <div>
                    @php
                        $color = match($pedido->estado) {
                            'Pendiente'  => ['bg' => '#fef9c3', 'text' => '#854d0e'],
                            'Completado' => ['bg' => '#dcfce7', 'text' => '#166534'],
                            'Cancelado'  => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                            default      => ['bg' => '#f3f4f6', 'text' => '#374151'],
                        };
                    @endphp
                    <span style="background:{{ $color['bg'] }};color:{{ $color['text'] }};padding:4px 14px;border-radius:999px;font-size:12px;font-weight:700;">
                        {{ $pedido->estado }}
                    </span>
                </div>

                <a href="{{ route('pedidos.show', $pedido) }}"
                   style="background:#dc2626;color:white;padding:8px 20px;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;white-space:nowrap;">
                    Ver detalle →
                </a>

            </div>
            @endforeach
        </div>
    @endif

</div>

@endsection