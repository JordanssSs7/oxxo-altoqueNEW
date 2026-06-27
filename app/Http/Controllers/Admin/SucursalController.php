<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::orderBy('nombre')->get();
        return view('sucursales_admin.index', compact('sucursales'));
    }

    public function create()
    {
        return view('sucursales_admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:100',
            'distrito'  => 'required|string|max:100',
            'direccion' => 'required|string|max:200',
            'horario'   => 'required|string|max:100',
            'telefono'  => 'nullable|string|max:20',
            'lat'       => 'nullable|numeric',
            'lng'       => 'nullable|numeric',
        ]);

        Sucursal::create(array_merge(
            $request->only('nombre','distrito','direccion','horario','telefono','lat','lng'),
            ['activo' => $request->boolean('activo', true)]
        ));

        return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal creada correctamente.');
    }

    public function edit(string $id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales_admin.edit', compact('sucursal'));
    }

    public function update(Request $request, string $id)
    {
        $sucursal = Sucursal::findOrFail($id);

        $request->validate([
            'nombre'    => 'required|string|max:100',
            'distrito'  => 'required|string|max:100',
            'direccion' => 'required|string|max:200',
            'horario'   => 'required|string|max:100',
            'telefono'  => 'nullable|string|max:20',
            'lat'       => 'nullable|numeric',
            'lng'       => 'nullable|numeric',
        ]);

        $sucursal->update(array_merge(
            $request->only('nombre','distrito','direccion','horario','telefono','lat','lng'),
            ['activo' => $request->boolean('activo')]
        ));

        return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        Sucursal::findOrFail($id)->delete();
        return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal eliminada correctamente.');
    }
}
