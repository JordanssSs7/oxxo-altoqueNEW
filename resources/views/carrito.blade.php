@extends('layouts.public')

@section('contenido')
<div class="max-w-4xl mx-auto px-6 py-12">

    <h1 class="text-2xl font-bold text-gray-800 mb-8">🛒 Mi carrito</h1>

    @if(empty($carrito))
    {{-- Carrito vacío --}}
    <div class="text-center py-20">
        <div class="text-7xl mb-4">🛍️</div>
        <p class="text-xl font-semibold text-gray-600 mb-2">Tu carrito está vacío</p>
        <p class="text-gray-400 mb-8">Agrega productos desde el catálogo</p>
        <a href="{{ route('catalogo') }}"
           class="bg-red-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-red-700 transition">
            Ver productos
        </a>
    </div>

    @else
    <div class="grid grid-cols-3 gap-8">

        {{-- Lista de productos --}}
        <div class="col-span-2 space-y-4">
            @foreach($carrito as $id => $item)
            <div id="fila-{{ $id }}" class="bg-white rounded-2xl shadow p-4 flex items-center gap-4"
                 data-stock="{{ $item['stock'] ?? 9999 }}">

                {{-- Imagen --}}
                @if($item['imagen'])
                <img src="{{ asset('storage/' . $item['imagen']) }}"
                     alt="{{ $item['nombre'] }}"
                     class="w-20 h-20 object-cover rounded-xl">
                @else
                <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center text-3xl">🛍️</div>
                @endif

                {{-- Info --}}
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">{{ $item['nombre'] }}</p>
                    <p class="text-sm text-gray-400">S/. {{ number_format($item['precio'], 2) }} c/u</p>
                    <p id="subtotal-{{ $id }}" class="text-sm font-semibold text-red-600 mt-1">
                        Subtotal: S/. {{ number_format($item['precio'] * $item['cantidad'], 2) }}
                    </p>
                </div>

                {{-- Cantidad con controles --}}
                @php $stock = $item['stock'] ?? 9999; @endphp
                <div class="flex items-center gap-2" id="controles-{{ $id }}">
                    <button onclick="cambiarCantidad({{ $id }}, 'decrementar')"
                            style="width:30px;height:30px;border-radius:50%;border:1px solid #e5e7eb;background:white;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                        −
                    </button>
                    <span id="cantidad-{{ $id }}" class="text-lg font-bold text-gray-800 w-6 text-center">{{ $item['cantidad'] }}</span>
                    <button id="btn-inc-{{ $id }}" onclick="cambiarCantidad({{ $id }}, 'incrementar')"
                            style="width:30px;height:30px;border-radius:50%;border:1px solid #e5e7eb;background:white;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;"
                            {{ $item['cantidad'] >= $stock ? 'disabled' : '' }}
                            title="{{ $item['cantidad'] >= $stock ? 'Límite de stock alcanzado' : '' }}">
                        +
                    </button>
                </div>

                {{-- Quitar --}}
                <form method="POST" action="{{ route('carrito.quitar') }}">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $id }}">
                    <button type="submit"
                            class="text-gray-300 hover:text-red-500 transition text-2xl font-light leading-none"
                            title="Eliminar">
                        &times;
                    </button>
                </form>
            </div>
            @endforeach

            <a href="{{ route('catalogo') }}" class="inline-block mt-2 text-sm text-red-600 hover:underline font-medium">
                ← Seguir comprando
            </a>
        </div>

        {{-- Resumen --}}
        <div class="col-span-1">
            <div class="bg-white rounded-2xl shadow p-6 sticky top-24">
                <h2 class="font-semibold text-gray-700 mb-4 text-lg">Resumen</h2>

                <div class="space-y-2 text-sm text-gray-500 mb-4">
                    @foreach($carrito as $resId => $item)
                    <div id="resumen-{{ $resId }}" class="flex justify-between">
                        <span>{{ $item['nombre'] }} ×<span id="res-cant-{{ $resId }}">{{ $item['cantidad'] }}</span></span>
                        <span id="res-sub-{{ $resId }}">S/. {{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between font-bold text-gray-800 text-lg">
                    <span>Total</span>
                    <span id="total-carrito">S/. {{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('carrito.pago') }}"
                   class="block w-full text-center bg-red-600 text-white py-3 rounded-xl font-semibold hover:bg-red-700 transition">
                    Ir a pagar
                </a>
            </div>
        </div>

    </div>
    @endif

</div>
<script>
const token = '{{ csrf_token() }}';

function cambiarCantidad(id, accion) {
    fetch(`/carrito/${accion}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
        body: JSON.stringify({ producto_id: id })
    })
    .then(r => r.json())
    .then(data => {
        if (data.eliminado) {
            document.getElementById('fila-' + id).remove();
            document.getElementById('resumen-' + id)?.remove();
        } else {
            document.getElementById('cantidad-' + id).textContent = data.cantidad;
            document.getElementById('subtotal-' + id).textContent = 'Subtotal: S/. ' + data.subtotal;
            document.getElementById('res-cant-' + id).textContent = data.cantidad;
            document.getElementById('res-sub-' + id).textContent  = 'S/. ' + data.subtotal;

            const btnInc = document.getElementById('btn-inc-' + id);
            if (btnInc) {
                const bloqueado = data.sin_stock === true;
                btnInc.disabled = bloqueado;
                btnInc.style.opacity = bloqueado ? '0.35' : '1';
                btnInc.style.cursor  = bloqueado ? 'not-allowed' : 'pointer';
                btnInc.title         = bloqueado ? 'Límite de stock alcanzado' : '';
            }
        }
        document.getElementById('total-carrito').textContent = 'S/. ' + data.total;
        document.getElementById('badge-carrito').textContent = data.count;
        if (data.count === 0) location.reload();
    });
}
</script>

@endsection
