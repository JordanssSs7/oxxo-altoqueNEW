@extends('layouts.public')

@section('contenido')
<div class="max-w-xl mx-auto px-6 py-10">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Producto</h1>

    {{-- Errores --}}
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
        <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select name="categoria_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                        required>
                    <option value="">[ Seleccione una categoría ]</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('categoria_id', $producto->categoria_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Precio (S/.)</label>
                <input type="number" name="precio" value="{{ old('precio', $producto->precio) }}" step="0.01" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Precio oferta (S/.) <span class="text-gray-400 font-normal">— opcional</span></label>
                <input type="number" name="precio_oferta" value="{{ old('precio_oferta', $producto->precio_oferta) }}" step="0.01" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       placeholder="Déjalo vacío para quitar la oferta">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                         alt="Imagen actual"
                         class="w-20 h-20 object-cover rounded mb-2">
                    <p class="text-xs text-gray-400 mb-2">Imagen actual — sube una nueva para reemplazarla</p>
                @endif
                <input type="file" name="imagen" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        style="background:#dc2626;color:white;padding:8px 20px;border-radius:8px;border:none;cursor:pointer;">
                    Actualizar
                </button>
                <a href="{{ route('admin.productos.index') }}"
                   style="background:#e5e7eb;color:#374151;padding:8px 20px;border-radius:8px;text-decoration:none;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
