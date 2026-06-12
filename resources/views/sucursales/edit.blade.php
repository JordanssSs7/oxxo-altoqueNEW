<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-2">Editar Sucursal</h1>
                <p class="text-gray-600 mb-6">
                    Modifica los datos de la sucursal seleccionada.
                </p>

                <form action="{{ route('sucursales.update', ['sucursal' => $sucursal->id]) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold mb-1">Nombre</label>
                        <input type="text"
                                name="nombre"
                                value="{{ $sucursal->nombre }}"
                                class="w-full border rounded px-3 py-2"
                                required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Direccion</label>
                        <input type="text"
                                name="direccion"
                                value="{{ $sucursal->direccion }}"
                                class="w-full border rounded px-3 py-2"
                                required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Telefono</label>
                        <input type="text"
                                name="telefono"
                                value="{{ $sucursal->telefono }}"
                                class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Ciudad</label>
                        <input type="text"
                                name="ciudad"
                                value="{{ $sucursal->ciudad }}"
                                class="w-full border rounded px-3 py-2"
                                required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Estado</label>
                        <select name="activa" class="w-full border rounded px-3 py-2">
                            <option value="1" {{ $sucursal->activa ? 'selected' : '' }}>
                                Activa
                            </option>

                            <option value="0" {{ !$sucursal->activa ? 'selected' : '' }}>
                                Inactiva
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('sucursales.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded">
                            Actualizar Sucursal
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>