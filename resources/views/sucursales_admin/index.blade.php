@extends('layouts.public')

@section('contenido')
<div class="max-w-6xl mx-auto px-6 py-10">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Sucursales</h1>
        <a href="{{ route('admin.sucursales.create') }}"
           class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
            + Nueva sucursal
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Distrito</th>
                    <th class="px-6 py-3 text-left">Dirección</th>
                    <th class="px-6 py-3 text-left">Horario</th>
                    <th class="px-6 py-3 text-center">Estado</th>
                    <th class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($sucursales as $sucursal)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $sucursal->nombre }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $sucursal->distrito }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $sucursal->direccion }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $sucursal->horario }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($sucursal->activo)
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Activa</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 text-xs font-bold px-3 py-1 rounded-full">Inactiva</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.sucursales.edit', $sucursal->id) }}"
                               style="background:#ca8a04;color:white;padding:4px 10px;border-radius:6px;font-size:12px;text-decoration:none;">
                                Editar
                            </a>
                            <form action="{{ route('admin.sucursales.destroy', $sucursal->id) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar esta sucursal?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="background:#dc2626;color:white;padding:4px 10px;border-radius:6px;font-size:12px;border:none;cursor:pointer;">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-gray-400">No hay sucursales registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
