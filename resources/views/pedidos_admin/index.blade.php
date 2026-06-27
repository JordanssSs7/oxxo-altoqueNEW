@extends('layouts.public')

@section('contenido')
<div class="max-w-6xl mx-auto px-6 py-10">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Gestión de pedidos</h1>
            <p class="text-sm text-gray-400 mt-1">Todos los pedidos realizados por los clientes</p>
        </div>
        <span class="bg-gray-100 text-gray-600 text-sm font-semibold px-4 py-2 rounded-full">
            {{ $pedidos->count() }} pedido{{ $pedidos->count() !== 1 ? 's' : '' }}
        </span>
    </div>

    @if($pedidos->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center text-gray-400">
            <p class="text-4xl mb-3">📭</p>
            <p class="font-medium">No hay pedidos registrados aún.</p>
        </div>
    @else
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-500 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-3 text-left">Referencia</th>
                        <th class="px-5 py-3 text-left">Cliente</th>
                        <th class="px-5 py-3 text-left">Sucursal</th>
                        <th class="px-5 py-3 text-right">Total</th>
                        <th class="px-5 py-3 text-center">Estado</th>
                        <th class="px-5 py-3 text-left">Fecha</th>
                        <th class="px-5 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($pedidos as $pedido)
                    @php
                        $colores = [
                            'Pendiente' => 'bg-yellow-100 text-yellow-700',
                            'Listo'     => 'bg-blue-100 text-blue-700',
                            'Entregado' => 'bg-green-100 text-green-700',
                            'Cancelado' => 'bg-red-100 text-red-700',
                        ];
                        $badge = $colores[$pedido->estado] ?? 'bg-gray-100 text-gray-600';
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-4 font-bold text-gray-800 tracking-wide">{{ $pedido->referencia }}</td>
                        <td class="px-5 py-4">
                            <p class="font-medium text-gray-800">{{ $pedido->user->name ?? 'Sin usuario' }}</p>
                            <p class="text-xs text-gray-400">{{ $pedido->user->email ?? '' }}</p>
                        </td>
                        <td class="px-5 py-4 text-gray-600">{{ $pedido->sucursal->nombre ?? 'Sin sucursal' }}</td>
                        <td class="px-5 py-4 text-right font-semibold text-gray-800">S/ {{ number_format($pedido->total, 2) }}</td>
                        <td class="px-5 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $badge }}">
                                {{ $pedido->estado }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-gray-500 text-xs">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-5 py-4 text-center">
                            <a href="{{ route('admin.pedidos.show', $pedido) }}"
                               style="background:#dc2626;color:white;padding:5px 14px;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;">
                                Ver detalle
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
