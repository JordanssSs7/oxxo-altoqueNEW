@extends('layouts.public')

@section('contenido')

<div class="max-w-xl mx-auto px-6 py-10">

    <a href="{{ route('admin.promociones.index') }}" class="text-sm text-gray-400 hover:text-red-600 transition mb-6 inline-block">
        ← Volver a promociones
    </a>

    <h1 class="text-2xl font-black text-gray-900 mb-6">Editar promoción</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white shadow rounded-xl p-6">

        {{-- Producto 1 (solo lectura) --}}
        <div class="flex items-center gap-4 mb-6 p-4 bg-gray-50 rounded-xl">
            @if($promocion->producto->imagen)
                <img src="{{ asset('storage/' . $promocion->producto->imagen) }}" class="w-14 h-14 object-cover rounded-xl">
            @else
                <div style="width:56px;height:56px;background:#f3f4f6;border-radius:12px;"></div>
            @endif
            <div>
                <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Producto 1</p>
                <p class="font-bold text-gray-900">{{ $promocion->producto->nombre }}</p>
                <p class="text-sm text-gray-500">S/ {{ number_format($promocion->producto->precio, 2) }}</p>
            </div>
        </div>

        <form action="{{ route('admin.promociones.update', $promocion->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Producto 2 --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Producto 2 <span class="text-gray-400 font-normal">— opcional</span></label>
                <input type="text" id="buscador2"
                       value="{{ $promocion->producto2 ? $promocion->producto2->nombre : '' }}"
                       placeholder="Escribe el nombre..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       autocomplete="off">
                <div id="sugerencias2" class="hidden border border-gray-200 rounded-lg mt-1 bg-white shadow-lg max-h-48 overflow-y-auto"></div>
                <input type="hidden" name="producto_id_2" id="producto_id_2" value="{{ $promocion->producto_id_2 }}">
                @if($promocion->producto2)
                    <p id="sel2" class="text-sm text-green-600 font-medium mt-1">✓ {{ $promocion->producto2->nombre }} seleccionado</p>
                @else
                    <p id="sel2" class="text-sm text-green-600 font-medium mt-1 hidden"></p>
                @endif
                @if($promocion->producto_id_2)
                    <button type="button" onclick="limpiarProd2()" class="text-xs text-red-500 hover:underline mt-1">Quitar producto 2</button>
                @endif
            </div>

            {{-- Precio --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Precio de oferta (S/.)</label>
                <input type="number" name="precio_oferta" value="{{ old('precio_oferta', $promocion->precio_oferta) }}" step="0.01" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       placeholder="Ej: 10.90" required>
            </div>

            {{-- Descripción --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción <span class="text-gray-400 font-normal">— opcional</span></label>
                <input type="text" name="descripcion" value="{{ old('descripcion', $promocion->descripcion) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       placeholder="Ej: Pack de 2 unidades">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        style="background:#dc2626;color:white;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-weight:700;">
                    Actualizar
                </button>
                <a href="{{ route('admin.promociones.index') }}"
                   style="background:#e5e7eb;color:#374151;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
const productos = @json($productos->map(fn($p) => ['id' => $p->id, 'nombre' => $p->nombre, 'precio' => $p->precio]));

const input2  = document.getElementById('buscador2');
const sugs2   = document.getElementById('sugerencias2');
const hidden2 = document.getElementById('producto_id_2');
const sel2    = document.getElementById('sel2');

input2.addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    sugs2.innerHTML = '';
    if (!q) { sugs2.classList.add('hidden'); return; }

    const filtrados = productos.filter(p => p.nombre.toLowerCase().includes(q));
    if (!filtrados.length) { sugs2.classList.add('hidden'); return; }

    filtrados.forEach(p => {
        const div = document.createElement('div');
        div.className = 'px-4 py-2 cursor-pointer hover:bg-red-50 text-sm text-gray-800';
        div.innerHTML = `<span class="font-medium">${p.nombre}</span> <span class="text-gray-400">— S/ ${parseFloat(p.precio).toFixed(2)}</span>`;
        div.addEventListener('click', () => {
            input2.value  = p.nombre;
            hidden2.value = p.id;
            sel2.textContent = '✓ ' + p.nombre + ' seleccionado';
            sel2.classList.remove('hidden');
            sugs2.classList.add('hidden');
        });
        sugs2.appendChild(div);
    });
    sugs2.classList.remove('hidden');
});

document.addEventListener('click', (e) => {
    if (!input2.contains(e.target) && !sugs2.contains(e.target)) sugs2.classList.add('hidden');
});

function limpiarProd2() {
    input2.value  = '';
    hidden2.value = '';
    sel2.textContent = '';
    sel2.classList.add('hidden');
}
</script>

@endsection