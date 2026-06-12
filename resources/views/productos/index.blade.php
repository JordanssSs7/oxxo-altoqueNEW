@extends('layouts.public')

@section('contenido')
<div class="max-w-6xl mx-auto px-6 py-10">

    {{-- Encabezado --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Productos</h1>
        <a href="{{ route('admin.productos.create') }}"
           style="background:#dc2626;color:white;padding:8px 16px;border-radius:8px;text-decoration:none;">
            + Nuevo producto
        </a>
    </div>

    {{-- Mensajes --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Imagen</th>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Categoría</th>
                    <th class="px-6 py-3 text-left">Precio</th>
                    <th class="px-6 py-3 text-left">Stock</th>
                    <th class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($productos as $producto)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if ($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}"
                                 alt="{{ $producto->nombre }}"
                                 class="w-12 h-12 object-cover rounded">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">
                                Sin imagen
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $producto->nombre }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $producto->categoria->nombre }}</td>
                    <td class="px-6 py-4 text-gray-700">S/. {{ number_format($producto->precio, 2) }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $producto->stock }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.productos.edit', $producto->id) }}"
                               style="background:#ca8a04;color:white;padding:4px 10px;border-radius:6px;font-size:12px;text-decoration:none;">
                                Editar
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-gray-400">
                        No hay productos registrados aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
