<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold">Lista de Sucursales</h1>
                        <p class="text-gray-600">
                            Gestiona las tiendas registradas de OXXO Al Toque.
                        </p>
                    </div>

                    <a href="{{ route('sucursales.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Nueva Sucursal
                    </a>
                </div>

                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Nombre</th>
                            <th class="border px-4 py-2">Direccion</th>
                            <th class="border px-4 py-2">Telefono</th>
                            <th class="border px-4 py-2">Ciudad</th>
                            <th class="border px-4 py-2">Estado</th>
                            <th class="border px-4 py-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sucursales as $sucursal)
                            <tr>
                                <td class="border px-4 py-2">{{ $sucursal->id }}</td>
                                <td class="border px-4 py-2">{{ $sucursal->nombre }}</td>
                                <td class="border px-4 py-2">{{ $sucursal->direccion }}</td>
                                <td class="border px-4 py-2">{{ $sucursal->telefono }}</td>
                                <td class="border px-4 py-2">{{ $sucursal->ciudad }}</td>

                                <td class="border px-4 py-2">
                                    {{ $sucursal->activa ? 'Activa' : 'Inactiva' }}
                                </td>

                                <td class="border px-4 py-2">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('sucursales.edit', $sucursal) }}"
                                            style="background-color:#eab308; color:white; width:96px; height:40px; border-radius:6px; display:flex; align-items:center; justify-content:center; font-weight:bold; text-decoration:none;">
                                            Editar
                                        </a>

                                        <form action="{{ route('sucursales.destroy', $sucursal) }}"
                                                method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('¿Seguro que deseas eliminar esta sucursal?')"
                                                    style="background-color:#dc2626; color:white; width:96px; height:40px; border-radius:6px; display:flex; align-items:center; justify-content:center; font-weight:bold; border:none; cursor:pointer;">
                                                Eliminar
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>