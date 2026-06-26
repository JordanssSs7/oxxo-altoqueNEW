@extends('layouts.public')

@section('contenido')
<div class="max-w-4xl mx-auto px-6 py-12">

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Mi cuenta</h1>
        <p class="text-gray-400 mt-1">Bienvenido de vuelta, {{ Auth::user()->name }}</p>
    </div>

    <div class="grid grid-cols-3 gap-6">

        {{-- Columna izquierda: info de perfil --}}
        <div class="col-span-2 space-y-4">

            {{-- Información de perfil --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4 pb-3 border-b border-gray-100">
                    Información de perfil
                </h2>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Nombre</p>
                        <p class="text-gray-800 font-medium">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Correo electrónico</p>
                        <p class="text-gray-800 font-medium">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Tipo de cuenta</p>
                        <span style="background:{{ Auth::user()->role === 'admin' ? '#dc2626' : '#16a34a' }};color:white;padding:3px 12px;border-radius:9999px;font-size:12px;font-weight:600;">
                            {{ Auth::user()->role === 'admin' ? 'Administrador' : 'Cliente' }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100 flex gap-3 items-center">
                    <a href="{{ route('profile.edit') }}"
                       style="background:#dc2626;color:white;padding:8px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">
                        Editar perfil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                style="padding:8px 20px;background:#f3f4f6;color:#374151;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>

            {{-- Panel admin (solo admin) --}}
            @if (Auth::user()->role === 'admin')
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Panel administrador</h2>
                <div class="flex gap-3">
                    <a href="{{ route('admin.categorias.index') }}"
                       style="flex:1;display:block;padding:12px 14px;background:#f9fafb;border-radius:8px;text-decoration:none;color:#374151;font-size:14px;font-weight:500;text-align:center;">
                        🗂️ Categorías
                    </a>
                    <a href="{{ route('admin.productos.index') }}"
                       style="flex:1;display:block;padding:12px 14px;background:#f9fafb;border-radius:8px;text-decoration:none;color:#374151;font-size:14px;font-weight:500;text-align:center;">
                        📦 Productos
                    </a>
                    <a href="{{ route('admin.sucursales.index') }}"
                       style="flex:1;display:block;padding:12px 14px;background:#f9fafb;border-radius:8px;text-decoration:none;color:#374151;font-size:14px;font-weight:500;text-align:center;">
                        🏪 Sucursales
</a>
                </div>
            </div>
            @endif

        </div>

        {{-- Columna derecha: foto de perfil --}}
        <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center text-center">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4 self-start">Foto de perfil</h2>

            {{-- Avatar --}}
            @if (Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                     alt="Foto de perfil"
                     class="w-28 h-28 rounded-full object-cover mb-4 border-4 border-gray-100 shadow">
            @else
                <div style="width:112px;height:112px;border-radius:9999px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:48px;margin-bottom:16px;border:4px solid #e5e7eb;">
                    👤
                </div>
            @endif

            @if (session('status') === 'foto-actualizada')
                <p style="color:#16a34a;font-size:13px;margin-bottom:8px;">¡Foto actualizada!</p>
            @endif

            {{-- Formulario subida --}}
            <form action="{{ route('profile.foto') }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <input type="file" name="foto" accept="image/*" required
                       style="width:100%;font-size:12px;color:#6b7280;margin-bottom:10px;">
                @error('foto')
                    <p style="color:#dc2626;font-size:12px;margin-bottom:6px;">{{ $message }}</p>
                @enderror
                <button type="submit"
                        style="width:100%;padding:8px;background:#dc2626;color:white;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;margin-top:4px;">
                    Subir foto
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
