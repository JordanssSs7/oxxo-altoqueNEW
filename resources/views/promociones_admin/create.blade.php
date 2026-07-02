@extends('layouts.public')

@section('contenido')

<div class="max-w-xl mx-auto px-6 py-10">

    <a href="{{ route('admin.promociones.index') }}" class="text-sm text-gray-400 hover:text-red-600 transition mb-6 inline-block">
        ← Volver a promociones
    </a>

    <h1 class="text-2xl font-black text-gray-900 mb-6">Agregar promoción</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('admin.promociones.store') }}" method="POST">
            @csrf

            {{-- Producto 1 --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Producto 1 <span class="text-red-500">*</span></label>
                <input type="text" id="buscador1" placeholder="Escribe el nombre..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       autocomplete="off">
                <div id="sugerencias1" class="hidden border border-gray-200 rounded-lg mt-1 bg-white shadow-lg max-h-48 overflow-y-auto"></div>
                <input type="hidden" name="producto_id" id="producto_id">
                <p id="sel1" class="text-sm text-green-600 font-medium mt-1 hidden"></p>
            </div>

            {{-- Producto 2 --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Producto 2 <span class="text-gray-400 font-normal">— opcional</span></label>
                <input type="text" id="buscador2" placeholder="Escribe el nombre..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       autocomplete="off">
                <div id="sugerencias2" class="hidden border border-gray-200 rounded-lg mt-1 bg-white shadow-lg max-h-48 overflow-y-auto"></div>
                <input type="hidden" name="producto_id_2" id="producto_id_2">
                <p id="sel2" class="text-sm text-green-600 font-medium mt-1 hidden"></p>
            </div>

            {{-- Precio --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Precio de oferta (S/.)</label>
                <input type="number" name="precio_oferta" value="{{ old('precio_oferta') }}" step="0.01" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       placeholder="Ej: 10.90" required>
            </div>

            {{-- Descripción --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción <span class="text-gray-400 font-normal">— opcional</span></label>
                <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                       placeholder="Ej: Pack de 2 unidades">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        style="background:#dc2626;color:white;padding:10px 24px;border-radius:8px;border:none;cursor:pointer;font-weight:700;">
                    Guardar
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

function crearBuscador(inputId, sugsId, hiddenId, selId) {
    const input  = document.getElementById(inputId);
    const sugs   = document.getElementById(sugsId);
    const hidden = document.getElementById(hiddenId);
    const sel    = document.getElementById(selId);

    input.addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        sugs.innerHTML = '';
        if (!q) { sugs.classList.add('hidden'); return; }

        let filtrados = productos.filter(p => p.nombre.toLowerCase().includes(q));
        if (!filtrados.length) { sugs.classList.add('hidden'); return; }

        filtrados.forEach(p => {
            const div = document.createElement('div');
            div.className = 'px-4 py-2 cursor-pointer hover:bg-red-50 text-sm text-gray-800';
            div.innerHTML = `<span class="font-medium">${p.nombre}</span> <span class="text-gray-400">— S/ ${parseFloat(p.precio).toFixed(2)}</span>`;
            div.addEventListener('click', () => {
                input.value  = p.nombre;
                hidden.value = p.id;
                sel.textContent = '✓ ' + p.nombre + ' seleccionado';
                sel.classList.remove('hidden');
                sugs.classList.add('hidden');
            });
            sugs.appendChild(div);
        });
        sugs.classList.remove('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !sugs.contains(e.target)) sugs.classList.add('hidden');
    });
}

crearBuscador('buscador1', 'sugerencias1', 'producto_id',   'sel1');
crearBuscador('buscador2', 'sugerencias2', 'producto_id_2', 'sel2');
</script>

@endsection