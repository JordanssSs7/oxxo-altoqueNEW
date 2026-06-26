<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display public listing of branches.
     */
    public function publicas()
    {
        $sucursales = Sucursal::orderBy('nombre')->get();

        return view('sucursales', compact('sucursales'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursales = Sucursal::orderBy('nombre')->get();

        return view('sucursales.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'distrito' => ['required', 'string', 'max:120'],
            'direccion' => ['required', 'string', 'max:200'],
            'horario' => ['required', 'string', 'max:120'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'estado' => ['required', 'in:Abierto,Cerrado,Proximamente'],
        ]);

        Sucursal::create($request->only([
            'nombre',
            'distrito',
            'direccion',
            'horario',
            'telefono',
            'estado',
        ]));

        return redirect()->route('admin.sucursales.index')
                         ->with('success', 'Sucursal creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.sucursales.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sucursal = Sucursal::findOrFail($id);

        return view('sucursales.edit', compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'distrito' => ['required', 'string', 'max:120'],
            'direccion' => ['required', 'string', 'max:200'],
            'horario' => ['required', 'string', 'max:120'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'estado' => ['required', 'in:Abierto,Cerrado,Proximamente'],
        ]);

        $sucursal = Sucursal::findOrFail($id);

        $sucursal->update($request->only([
            'nombre',
            'distrito',
            'direccion',
            'horario',
            'telefono',
            'estado',
        ]));

        return redirect()->route('admin.sucursales.index')
                         ->with('success', 'Sucursal actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->delete();

        return redirect()->route('admin.sucursales.index')
                         ->with('success', 'Sucursal eliminada correctamente.');
    }
}