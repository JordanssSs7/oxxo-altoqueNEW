@extends('layouts.public')

@section('contenido')
<div class="max-w-xl mx-auto px-6 py-10">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Categoría</h1>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition">
                    Actualizar
                </button>
                <a href="{{ route('admin.categorias.index') }}"
                   class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
