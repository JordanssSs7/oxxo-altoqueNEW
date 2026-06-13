<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session('carrito', []);
        $total   = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito));
        return view('carrito', compact('carrito', 'total'));
    }

    public function agregar(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);
        $carrito  = session('carrito', []);
        $id       = $producto->id;

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'nombre'   => $producto->nombre,
                'precio'   => $producto->precio,
                'cantidad' => 1,
                'imagen'   => $producto->imagen,
            ];
        }

        session(['carrito' => $carrito]);
        return back()->with('agregado', $producto->nombre);
    }

    public function quitar(Request $request)
    {
        $carrito = session('carrito', []);
        unset($carrito[$request->producto_id]);
        session(['carrito' => $carrito]);
        return back();
    }

    public function incrementar(Request $request)
    {
        $carrito = session('carrito', []);
        $id = $request->producto_id;
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
            session(['carrito' => $carrito]);
        }
        $total = number_format(array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito)), 2);
        return response()->json([
            'cantidad' => $carrito[$id]['cantidad'],
            'subtotal' => number_format($carrito[$id]['precio'] * $carrito[$id]['cantidad'], 2),
            'total'    => $total,
            'count'    => count($carrito),
        ]);
    }

    public function decrementar(Request $request)
    {
        $carrito = session('carrito', []);
        $id = $request->producto_id;
        $eliminado = false;
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']--;
            if ($carrito[$id]['cantidad'] <= 0) {
                unset($carrito[$id]);
                $eliminado = true;
            }
            session(['carrito' => $carrito]);
        }
        $total = number_format(array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito)), 2);
        return response()->json([
            'cantidad'  => $eliminado ? 0 : $carrito[$id]['cantidad'],
            'subtotal'  => $eliminado ? '0.00' : number_format($carrito[$id]['precio'] * $carrito[$id]['cantidad'], 2),
            'total'     => $total,
            'count'     => count($carrito),
            'eliminado' => $eliminado,
        ]);
    }

    public function pago()
    {
        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('catalogo');
        }

        $total      = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito));
        $referencia = 'OXT-' . strtoupper(substr(md5(uniqid()), 0, 8));
        session(['referencia_pago' => $referencia]);

        return view('pago', compact('carrito', 'total', 'referencia'));
    }

    public function confirmar()
    {
        $referencia = session('referencia_pago', 'OXT-00000000');
        session()->forget('carrito');
        return view('pedido-confirmado', compact('referencia'));
    }
}
