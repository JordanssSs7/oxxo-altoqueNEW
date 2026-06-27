@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pedidos</h1>

    @if($pedidos->isEmpty())
        <p>No hay pedidos registrados.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Usuario</th>
                    <th>Sucursal</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->referencia }}</td>
                        <td>{{ $pedido->user->name ?? 'Sin usuario' }}</td>
                        <td>{{ $pedido->sucursal->nombre ?? 'Sin sucursal' }}</td>
                        <td>S/ {{ number_format($pedido->total, 2) }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.pedidos.show', $pedido) }}">Ver detalle</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection