<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-2">Nuevo Producto</h1>
                <p class="text-gray-600 mb-6">
                    Registra un nuevo producto.
                </p>

                <form action="{{ route('productos.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-semibold mb-1">Nombre</label>
                        <input type="text" name="nombre"
                               class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Descripción</label>
                        <textarea name="descripcion"
                                  class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Precio</label>
                        <input type="number" step="0.01" name="precio"
                               class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Stock</label>
                        <input type="number" name="stock"
                               class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('productos.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded">
                            Guardar Producto
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>