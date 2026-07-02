<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocion;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promociones = Promocion::with('producto', 'producto2')->orderBy('created_at', 'desc')->get();
        return view('promociones_admin.index', compact('promociones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos  = Producto::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre')->get();
        return view('promociones_admin.create', compact('productos', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id'   => ['required', 'exists:productos,id'],
            'producto_id_2' => ['nullable', 'exists:productos,id', 'different:producto_id'],
            'precio_oferta' => ['required', 'numeric', 'min:0'],
            'descripcion'   => ['nullable', 'string', 'max:255'],
        ]);

        Promocion::create([
            'producto_id'   => $request->producto_id,
            'producto_id_2' => $request->producto_id_2 ?: null,
            'precio_oferta' => $request->precio_oferta,
            'descripcion'   => $request->descripcion,
        ]);

        return redirect()->route('admin.promociones.index')
                         ->with('success', 'Promoción agregada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the existing resource.
     */
    public function edit(string $id)
    {
        $promocion  = Promocion::with('producto', 'producto2')->findOrFail($id);
        $productos  = Producto::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('nombre')->get();
        return view('promociones_admin.edit', compact('promocion', 'productos', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'precio_oferta' => ['required', 'numeric', 'min:0'],
            'producto_id_2' => ['nullable', 'exists:productos,id'],
            'descripcion'   => ['nullable', 'string', 'max:255'],
        ]);

        $promocion = Promocion::findOrFail($id);
        $promocion->precio_oferta = $request->precio_oferta;
        $promocion->producto_id_2 = $request->producto_id_2 ?: null;
        $promocion->descripcion   = $request->descripcion;
        $promocion->save();

        return redirect()->route('admin.promociones.index')
                         ->with('success', 'Promoción actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Promocion::findOrFail($id)->delete();

        return redirect()->route('admin.promociones.index')
                         ->with('success', 'Promoción eliminada exitosamente.');
    }
}