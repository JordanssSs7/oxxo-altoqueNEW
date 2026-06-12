<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    // Lista todos los productos
    public function index()
    {
        try {
            $productos = Producto::orderBy('nombre')->get();
            return view('productos.index', compact('productos'));
        } catch (Exception $err) {
            Log::error('Error listando productos: ' . $err->getMessage());
            return back()->with('error', 'Ocurrió un error al obtener los productos.');
        }
    }

    // Muestra el formulario de crear
    public function create()
    {
        try {
            $categorias = Categoria::orderBy('nombre')->get();
            return view('productos.create', compact('categorias'));
        } catch (Exception $err) {
            Log::error('Error cargando formulario de producto: ' . $err->getMessage());
            return back()->with('error', 'Ocurrió un error al cargar el formulario.');
        }
    }

    // Guarda el nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => ['required', 'string', 'max:150'],
            'precio'       => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'imagen'       => ['nullable', 'image', 'max:2048'],
        ]);

        try {
            $imagenPath = null;
            if ($request->hasFile('imagen')) {
                $imagenPath = $request->file('imagen')->store('productos', 'public');
            }

            Producto::create([
                'nombre'       => $request->nombre,
                'precio'       => $request->precio,
                'stock'        => $request->stock,
                'categoria_id' => $request->categoria_id,
                'imagen'       => $imagenPath,
            ]);

            return redirect()->route('admin.productos.index')
                             ->with('success', 'Producto creado exitosamente.');
        } catch (Exception $err) {
            Log::error('Error creando producto: ' . $err->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error al crear el producto.');
        }
    }

    // Muestra el formulario de editar
    public function edit(string $id)
    {
        try {
            $producto   = Producto::findOrFail($id);
            $categorias = Categoria::orderBy('nombre')->get();
            return view('productos.edit', compact('producto', 'categorias'));
        } catch (Exception $err) {
            Log::error('Error obteniendo producto: ' . $err->getMessage());
            return back()->with('error', 'Producto no encontrado.');
        }
    }

    // Guarda los cambios
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre'       => ['required', 'string', 'max:150'],
            'precio'       => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'imagen'       => ['nullable', 'image', 'max:2048'],
        ]);

        try {
            $producto = Producto::findOrFail($id);

            $producto->nombre       = $request->nombre;
            $producto->precio       = $request->precio;
            $producto->stock        = $request->stock;
            $producto->categoria_id = $request->categoria_id;

            if ($request->hasFile('imagen')) {
                $producto->imagen = $request->file('imagen')->store('productos', 'public');
            }

            $producto->save();

            return redirect()->route('admin.productos.index')
                             ->with('success', 'Producto actualizado exitosamente.');
        } catch (Exception $err) {
            Log::error('Error actualizando producto: ' . $err->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error al actualizar el producto.');
        }
    }

    public function show(string $id)
    {
        return redirect()->route('admin.productos.index');
    }

    public function destroy(string $id)
    {
        return redirect()->route('admin.productos.index');
    }
}
