@extends('layouts.public')

@section('contenido')
<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Productos</h1>
        <p class="text-gray-400 mt-1">Encuentra todo lo que necesitas y recógelo en tu OXXO más cercano</p>
    </div>

    {{-- Filtro por categoría --}}
    @if ($categorias->count() > 0)
    <div class="flex flex-wrap gap-2 mb-8">
        <a href="{{ route('catalogo') }}"
           style="background:#dc2626;color:white;padding:6px 16px;border-radius:9999px;font-size:14px;font-weight:600;text-decoration:none;">
            Todos
        </a>
        @foreach ($categorias as $cat)
        <a href="{{ route('catalogo') }}?categoria={{ $cat->id }}"
           style="background:#f3f4f6;color:#374151;padding:6px 16px;border-radius:9999px;font-size:14px;font-weight:600;text-decoration:none;">
            {{ $cat->nombre }}
        </a>
        @endforeach
    </div>
    @endif

    {{-- Grid de productos --}}
    @forelse ($productos as $producto)
        @if (!request('categoria') || $producto->categoria_id == request('categoria'))
        <div style="display:none" class="catalogo-item" data-cat="{{ $producto->categoria_id }}"></div>
        @endif
    @empty
    @endforelse

    <div class="grid grid-cols-4 gap-6">
        @forelse ($productos as $producto)
            @if (!request('categoria') || $producto->categoria_id == request('categoria'))
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                {{-- Imagen --}}
                @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                         alt="{{ $producto->nombre }}"
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-300 text-4xl">
                        🛍️
                    </div>
                @endif

                {{-- Info --}}
                <div class="p-4">
                    <span class="text-xs text-red-500 font-semibold uppercase tracking-wide">
                        {{ $producto->categoria->nombre }}
                    </span>
                    <h3 class="font-semibold text-gray-800 mt-1 mb-2">{{ $producto->nombre }}</h3>

                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xl font-bold text-gray-900">
                            S/. {{ number_format($producto->precio, 2) }}
                        </span>
                        <span class="text-xs text-gray-400">
                            Stock: {{ $producto->stock }}
                        </span>
                    </div>

                    {{-- Botón agregar --}}
                    <button onclick="pedirLogin()"
                            style="width:100%;margin-top:12px;background:#dc2626;color:white;padding:8px 0;border-radius:8px;border:none;cursor:pointer;font-weight:600;">
                        Agregar al carrito
                    </button>
                </div>
            </div>
            @endif
        @empty
        <div class="col-span-4 text-center text-gray-400 py-16">
            <p class="text-5xl mb-4">📦</p>
            <p class="text-lg">No hay productos disponibles aún.</p>
        </div>
        @endforelse
    </div>

</div>

{{-- Modal aviso login --}}
<div id="modal-login" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:100;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:16px;padding:32px;max-width:380px;width:90%;text-align:center;">
        <div style="font-size:48px;margin-bottom:12px;">🔒</div>
        <h2 style="font-size:20px;font-weight:700;color:#111;margin-bottom:8px;">Inicia sesión primero</h2>
        <p style="color:#6b7280;font-size:14px;margin-bottom:24px;">
            Para agregar productos a tu carrito necesitas tener una cuenta.
        </p>
        <div style="display:flex;gap:12px;justify-content:center;">
            <a href="{{ route('login') }}"
               style="background:#dc2626;color:white;padding:10px 24px;border-radius:8px;font-weight:600;text-decoration:none;">
                Iniciar sesión
            </a>
            <a href="{{ route('register') }}"
               style="background:#f3f4f6;color:#374151;padding:10px 24px;border-radius:8px;font-weight:600;text-decoration:none;">
                Crear cuenta
            </a>
        </div>
        <button onclick="cerrarModal()"
                style="margin-top:16px;background:none;border:none;color:#9ca3af;cursor:pointer;font-size:13px;">
            Cancelar
        </button>
    </div>
</div>

<script>
function pedirLogin() {
    @auth
        // Si ya está logueado, aquí irá la lógica del carrito (próxima etapa)
        alert('Funcionalidad de carrito próximamente');
    @else
        document.getElementById('modal-login').style.display = 'flex';
    @endauth
}
function cerrarModal() {
    document.getElementById('modal-login').style.display = 'none';
}
</script>

@endsection
