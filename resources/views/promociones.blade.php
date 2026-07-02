@extends('layouts.public')

@section('contenido')
<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Ofertas especiales</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-1">Promociones</h1>
        <p class="text-gray-400 mt-1">Aprovecha los mejores precios en tu OXXO más cercano</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($promociones as $promocion)
        <div style="background:white;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,0.08);overflow:hidden;">

            @if($promocion->producto->imagen)
                <img src="{{ asset('storage/' . $promocion->producto->imagen) }}"
                     alt="{{ $promocion->producto->nombre }}"
                     style="width:100%;height:180px;object-fit:cover;">
            @else
                <div style="width:100%;height:180px;background:#f3f4f6;"></div>
            @endif

            <div style="padding:14px;">
                @if($promocion->descripcion)
                    <p style="font-size:13px;color:#6b7280;margin-bottom:4px;">{{ $promocion->descripcion }}</p>
                @endif
                <p style="font-weight:700;color:#111827;font-size:15px;line-height:1.3;">{{ $promocion->producto->nombre }}</p>
                @if($promocion->producto2)
                    <p style="font-size:13px;color:#6b7280;margin-bottom:10px;">+ {{ $promocion->producto2->nombre }}</p>
                @else
                    <div style="margin-bottom:10px;"></div>
                @endif

                <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
                    <span style="font-size:18px;font-weight:900;color:#111827;">S/ {{ number_format($promocion->precio_oferta, 2) }}</span>
                    <span style="font-size:13px;color:#9ca3af;text-decoration:line-through;">S/ {{ number_format($promocion->producto->precio + ($promocion->producto2 ? $promocion->producto2->precio : 0), 2) }}</span>
                </div>

                <form action="{{ route('carrito.agregarPromo') }}" method="POST">
                    @csrf
                    <input type="hidden" name="promocion_id" value="{{ $promocion->id }}">
                    <button type="submit"
                            style="display:block;width:100%;background:#dc2626;color:white;padding:8px 0;border-radius:8px;text-align:center;font-weight:600;border:none;cursor:pointer;font-size:14px;">
                        + Agregar al carrito
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center text-gray-400 py-16">
            <p class="text-lg">No hay promociones disponibles aún.</p>
        </div>
        @endforelse
    </div>

</div>
@endsection