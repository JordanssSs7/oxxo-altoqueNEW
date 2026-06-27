@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del pedido</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p><strong>Referencia:</strong> {{ $pedido->referencia }}</p>
    <p><strong>Usuario:</strong> {{ $pedido->user->name ?? 'Sin usuario' }}</p>
    <p><strong>Email:</strong> {{ $pedido->user->email ?? '-' }}</p>
    <p><strong>Sucursal:</strong> {{ $pedido->sucursal->nombre ?? 'Sin sucursal' }}</p>
    <p><strong>Dirección:</strong> {{ $pedido->sucursal->direccion ?? '-' }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

    <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="estado"><strong>Estado:</strong></label>
        <select name="estado" id="estado">
            <option value="Pendiente" {{ $pedido->estado === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Listo" {{ $pedido->estado === 'Listo' ? 'selected' : '' }}>Listo</option>
            <option value="Entregado" {{ $pedido->estado === 'Entregado' ? 'selected' : '' }}>Entregado</option>
            <option value="Cancelado" {{ $pedido->estado === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>

        <button type="submit">Actualizar estado</button>
    </form>

    <h2>Productos</h2>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->nombre_producto }}</td>
                    <td>S/ {{ number_format($detalle->precio, 2) }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>S/ {{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Total: S/ {{ number_format($pedido->total, 2) }}</h2>

    <a href="{{ route('admin.pedidos.index') }}">Volver a pedidos</a>
</div>
@endsection