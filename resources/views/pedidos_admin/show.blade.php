@extends('layouts.public')

@section('contenido')
<div class="max-w-3xl mx-auto px-6 py-10">

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.pedidos.index') }}" class="text-gray-400 hover:text-red-600 text-sm">← Volver a pedidos</a>
        <h1 class="text-2xl font-bold text-gray-800">Detalle del pedido</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Referencia + estado --}}
    @php
        $colores = [
            'Pendiente' => ['bg' => '#fef9c3', 'text' => '#854d0e'],
            'Listo'     => ['bg' => '#dbeafe', 'text' => '#1e40af'],
            'Entregado' => ['bg' => '#dcfce7', 'text' => '#166534'],
            'Cancelado' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
        ];
        $c = $colores[$pedido->estado] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
    @endphp
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-5 py-4 mb-6 flex items-center justify-between">
        <div>
            <p class="text-xs text-yellow-600 font-medium mb-1">Código de referencia</p>
            <p class="font-black text-gray-900 tracking-widest text-lg">{{ $pedido->referencia }}</p>
        </div>
        <span style="background:{{ $c['bg'] }};color:{{ $c['text'] }};padding:6px 16px;border-radius:999px;font-size:13px;font-weight:700;">
            {{ $pedido->estado }}
        </span>
    </div>

    <div class="grid grid-cols-2 gap-6 mb-6">

        {{-- Info cliente --}}
        <div class="bg-white rounded-2xl shadow-sm p-5">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">👤 Cliente</h3>
            <p class="font-semibold text-gray-800">{{ $pedido->user->name ?? 'Sin usuario' }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $pedido->user->email ?? '-' }}</p>
            <p class="text-xs text-gray-400 mt-2">📅 {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
        </div>

        {{-- Sucursal --}}
        <div class="bg-red-50 border border-red-200 rounded-2xl p-5">
            <h3 class="text-xs font-semibold text-red-600 uppercase tracking-wide mb-3">📍 Sucursal de recojo</h3>
            <p class="font-semibold text-gray-800">{{ $pedido->sucursal->nombre ?? 'Sin sucursal' }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $pedido->sucursal->direccion ?? '-' }}</p>
        </div>

    </div>

    {{-- Cambiar estado --}}
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-6">
        <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">🔄 Cambiar estado</h3>
        <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST" class="flex items-center gap-3">
            @csrf @method('PUT')
            <select name="estado"
                    class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                <option value="Pendiente"  {{ $pedido->estado === 'Pendiente'  ? 'selected' : '' }}>Pendiente</option>
                <option value="Listo"      {{ $pedido->estado === 'Listo'      ? 'selected' : '' }}>Listo</option>
                <option value="Entregado"  {{ $pedido->estado === 'Entregado'  ? 'selected' : '' }}>Entregado</option>
                <option value="Cancelado"  {{ $pedido->estado === 'Cancelado'  ? 'selected' : '' }}>Cancelado</option>
            </select>
            <button type="submit"
                    class="bg-red-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                Guardar cambio
            </button>
        </form>
    </div>

    {{-- Productos --}}
    <div class="bg-white rounded-2xl shadow-sm p-5">
        <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">🛒 Productos</h3>
        <div class="space-y-2">
            @foreach($pedido->detalles as $detalle)
            <div class="flex justify-between items-center text-sm py-2 border-b border-gray-100">
                <div>
                    <p class="font-semibold text-gray-800">{{ $detalle->nombre_producto }}</p>
                    <p class="text-gray-400 text-xs">{{ $detalle->cantidad }} × S/ {{ number_format($detalle->precio, 2) }}</p>
                </div>
                <span class="font-bold text-gray-700">S/ {{ number_format($detalle->subtotal, 2) }}</span>
            </div>
            @endforeach
            <div class="flex justify-between items-center pt-3 font-black text-gray-900">
                <span>Total</span>
                <span>S/ {{ number_format($pedido->total, 2) }}</span>
            </div>
        </div>
    </div>

</div>
@endsection
