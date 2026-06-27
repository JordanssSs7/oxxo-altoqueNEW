@extends('layouts.public')

@section('contenido')
<div class="max-w-2xl mx-auto px-6 py-10">

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.sucursales.index') }}" class="text-gray-400 hover:text-red-600">← Volver</a>
        <h1 class="text-2xl font-bold text-gray-800">Editar sucursal</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('admin.sucursales.update', $sucursal->id) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $sucursal->nombre) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" required>
                @error('nombre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Distrito</label>
                <input type="text" name="distrito" value="{{ old('distrito', $sucursal->distrito) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" required>
                @error('distrito')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $sucursal->direccion) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" required>
                @error('direccion')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Horario</label>
                <input type="text" name="horario" value="{{ old('horario', $sucursal->horario) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" required>
                @error('horario')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono (opcional)</label>
                <input type="text" name="telefono" value="{{ old('telefono', $sucursal->telefono) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Coordenadas (opcional)</label>
                <p class="text-xs text-gray-400 mb-2">
                    💡 Para obtener las coordenadas: abre
                    <a href="https://maps.google.com" target="_blank" class="text-red-500 underline">Google Maps</a>,
                    haz clic derecho sobre la tienda y copia los números que aparecen (ej: -12.1211, -77.0282).
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Latitud</label>
                        <input type="number" step="any" name="lat" value="{{ old('lat', $sucursal->lat) }}" placeholder="-12.1211"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Longitud</label>
                        <input type="number" step="any" name="lng" value="{{ old('lng', $sucursal->lng) }}" placeholder="-77.0282"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="activo" id="activo" value="1"
                       {{ $sucursal->activo ? 'checked' : '' }} class="w-4 h-4 accent-red-600">
                <label for="activo" class="text-sm text-gray-700">Sucursal activa</label>
            </div>

            <button type="submit"
                    class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                Guardar cambios
            </button>
        </form>
    </div>
</div>
@endsection
