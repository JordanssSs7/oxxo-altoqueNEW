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

        $sucursales = $this->listaSucursales();
        return view('pago', compact('carrito', 'total', 'referencia', 'sucursales'));
    }

    public function confirmar(Request $request)
    {
        $request->validate(['sucursal_id' => 'required|integer|between:1,5']);

        $sucursales = $this->listaSucursales();
        $sucursal   = $sucursales[$request->sucursal_id] ?? null;

        if (!$sucursal) {
            return back()->withErrors(['sucursal_id' => 'Selecciona una sucursal válida.']);
        }

        $carrito = session('carrito', []);
        $total   = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito));

        session(['sucursal_pedido' => $sucursal]);
        session(['total_pedido'    => $total]);
        session()->forget('carrito');

        return redirect()->route('carrito.confirmado');
    }

    public function confirmado()
    {
        $referencia = session('referencia_pago', 'OXT-00000000');
        $sucursal   = session('sucursal_pedido');

        if (!$sucursal) {
            return redirect()->route('catalogo');
        }

        $total      = session('total_pedido', 0);
        $yapePhone  = config('services.yape.phone');

        return view('pedido-confirmado', compact('referencia', 'sucursal', 'total', 'yapePhone'));
    }

    public static function listaSucursales(): array
    {
        return [
            1 => ['nombre' => 'OXXO Miraflores', 'distrito' => 'Miraflores, Lima',        'direccion' => 'Av. Larco 345, Miraflores',             'horario' => 'Lun–Dom 7:00 am – 11:00 pm',  'lat' => -12.1211, 'lng' => -77.0282, 'telefono' => '(01) 234-5678'],
            2 => ['nombre' => 'OXXO San Isidro',  'distrito' => 'San Isidro, Lima',        'direccion' => 'Calle Los Libertadores 120, San Isidro', 'horario' => 'Lun–Dom 6:30 am – 11:30 pm', 'lat' => -12.0964, 'lng' => -77.0432, 'telefono' => '(01) 345-6789'],
            3 => ['nombre' => 'OXXO Surco',        'distrito' => 'Santiago de Surco, Lima', 'direccion' => 'Av. Primavera 890, Surco',              'horario' => 'Lun–Dom 7:00 am – 12:00 am',  'lat' => -12.1226, 'lng' => -76.9924, 'telefono' => '(01) 456-7890'],
            4 => ['nombre' => 'OXXO Barranco',     'distrito' => 'Barranco, Lima',          'direccion' => 'Av. Grau 210, Barranco',                'horario' => 'Lun–Dom 8:00 am – 10:00 pm',  'lat' => -12.1491, 'lng' => -77.0219, 'telefono' => '(01) 567-8901'],
            5 => ['nombre' => 'OXXO San Borja',    'distrito' => 'San Borja, Lima',         'direccion' => 'Av. San Luis 1850, San Borja',          'horario' => 'Lun–Dom 7:00 am – 11:00 pm',  'lat' => -12.1015, 'lng' => -76.9980, 'telefono' => '(01) 678-9012'],
        ];
    }
}
