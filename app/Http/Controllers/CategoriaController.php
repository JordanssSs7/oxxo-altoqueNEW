<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    // Lista todas las categorías
    public function index()
    {
        try {
            $categorias = Categoria::orderBy('nombre')->get();
            return view('categorias.index', compact('categorias'));
        } catch (Exception $err) {
            Log::error('Error listando categorías: ' . $err->getMessage());
            return back()->with('error', 'Ocurrió un error al obtener las categorías.');
        }
    }

    // Muestra el formulario de crear
    public function create()
    {
        return view('categorias.create');
    }

    // Guarda la nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string'],
        ]);

        try {
            Categoria::create([
                'nombre'      => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);

            return redirect()->route('admin.categorias.index')
                             ->with('success', 'Categoría creada exitosamente.');
        } catch (Exception $err) {
            Log::error('Error creando categoría: ' . $err->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error al crear la categoría.');
        }
    }

    // Muestra el formulario de editar
    public function edit(string $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            return view('categorias.edit', compact('categoria'));
        } catch (Exception $err) {
            Log::error('Error obteniendo categoría: ' . $err->getMessage());
            return back()->with('error', 'Categoría no encontrada.');
        }
    }

    // Guarda los cambios de la edición
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre'      => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string'],
        ]);

        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->nombre      = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->save();

            return redirect()->route('admin.categorias.index')
                             ->with('success', 'Categoría actualizada exitosamente.');
        } catch (Exception $err) {
            Log::error('Error actualizando categoría: ' . $err->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error al actualizar la categoría.');
        }
    }

    

}
