@extends('layouts.public')

@section('contenido')
<div class="max-w-5xl mx-auto px-6 py-10">

    {{-- Encabezado --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Categorías</h1>
        <a href="{{ route('admin.categorias.create') }}"
           class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
            + Nueva categoría
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
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Descripción</th>
                    <th class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($categorias as $categoria)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $categoria->nombre }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $categoria->descripcion ?? '—' }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.categorias.edit', $categoria->id) }}"
                               style="background:#ca8a04;color:white;padding:4px 10px;border-radius:6px;font-size:12px;text-decoration:none;">
                                Editar
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-gray-400">
                        No hay categorías registradas aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
