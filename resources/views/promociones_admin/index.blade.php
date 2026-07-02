@extends('layouts.public')

@section('contenido')

<div class="max-w-5xl mx-auto px-6 py-12">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900">Promociones</h1>
            <p class="text-gray-400 mt-1 text-sm">Gestiona los productos en oferta</p>
        </div>
        <a href="{{ route('admin.promociones.create') }}"
           style="background:#dc2626;color:white;padding:10px 22px;border-radius:8px;font-weight:700;font-size:14px;text-decoration:none;">
            + Agregar promoción
        </a>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #bbf7d0;color:#166534;border-radius:12px;padding:12px 20px;margin-bottom:24px;font-size:14px;font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    @if($promociones->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
            <h2 class="text-xl font-bold text-gray-700 mb-2">No hay promociones activas</h2>
            <p class="text-gray-400 text-sm mb-6">Agrega una promoción para que aparezca en la página de promociones.</p>
            <a href="{{ route('admin.promociones.create') }}"
               style="background:#dc2626;color:white;padding:10px 22px;border-radius:8px;font-weight:700;font-size:14px;text-decoration:none;">
                + Agregar promoción
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($promociones as $promocion)
            <div class="bg-white rounded-2xl shadow-sm px-6 py-5 flex items-center justify-between gap-4">

                <div class="flex items-center gap-4">
                    @if($promocion->producto->imagen)
                        <img src="{{ asset('storage/' . $promocion->producto->imagen) }}"
                             class="w-14 h-14 object-cover rounded-xl">
                    @else
                        <div style="width:56px;height:56px;background:#f3f4f6;border-radius:12px;"></div>
                    @endif
                    <div>
                        <p class="font-bold text-gray-900">{{ $promocion->producto->nombre }}</p>
                        @if($promocion->producto2)
                            <p class="text-xs text-gray-500">+ {{ $promocion->producto2->nombre }}</p>
                        @endif
                        @if($promocion->descripcion)
                            <p class="text-xs text-gray-400">{{ $promocion->descripcion }}</p>
                        @endif
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-xs text-gray-400">Precio normal</p>
                    <p class="font-semibold text-gray-600 line-through">S/ {{ number_format($promocion->producto->precio + ($promocion->producto2 ? $promocion->producto2->precio : 0), 2) }}</p>
                </div>

                <div class="text-center">
                    <p class="text-xs text-gray-400">Precio oferta</p>
                    <p class="text-xl font-black text-red-600">S/ {{ number_format($promocion->precio_oferta, 2) }}</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('admin.promociones.edit', $promocion->id) }}"
                       style="background:#f3f4f6;color:#374151;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;">
                        Editar
                    </a>
                    <form action="{{ route('admin.promociones.destroy', $promocion->id) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar esta promoción?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background:#fee2e2;color:#991b1b;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:700;border:none;cursor:pointer;">
                            Eliminar
                        </button>
                    </form>
                </div>

            </div>
            @endforeach
        </div>
    @endif

</div>

@endsection