<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
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

        $cantidadActual = isset($carrito[$id]) ? $carrito[$id]['cantidad'] : 0;

        if ($cantidadActual >= $producto->stock) {
            return back()->with('stock_agotado', $producto->nombre);
        }

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'nombre'   => $producto->nombre,
                'precio'   => $producto->precio,
                'cantidad' => 1,
                'imagen'   => $producto->imagen,
                'stock'    => $producto->stock,
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

        if (!isset($carrito[$id])) {
            return response()->json(['error' => 'not_found'], 404);
        }

        $stock = $carrito[$id]['stock'] ?? Producto::find($id)?->stock ?? 0;

        if ($carrito[$id]['cantidad'] >= $stock) {
            $total = number_format(array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito)), 2);
            return response()->json([
                'cantidad'  => $carrito[$id]['cantidad'],
                'subtotal'  => number_format($carrito[$id]['precio'] * $carrito[$id]['cantidad'], 2),
                'total'     => $total,
                'count'     => count($carrito),
                'sin_stock' => true,
                'stock'     => $stock,
            ]);
        }

        $carrito[$id]['cantidad']++;
        session(['carrito' => $carrito]);

        $total = number_format(array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito)), 2);
        return response()->json([
            'cantidad'  => $carrito[$id]['cantidad'],
            'subtotal'  => number_format($carrito[$id]['precio'] * $carrito[$id]['cantidad'], 2),
            'total'     => $total,
            'count'     => count($carrito),
            'sin_stock' => $carrito[$id]['cantidad'] >= $stock,
            'stock'     => $stock,
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

        $sucursales = \App\Models\Sucursal::where('activo', true)->orderBy('nombre')->get();
        return view('pago', compact('carrito', 'total', 'referencia', 'sucursales'));
    }

    public function confirmar(Request $request)
    {
        $request->validate([
            'sucursal_id' => 'required|exists:sucursales,id',
        ]);
    
        $carrito = session('carrito', []);
    
        if (empty($carrito)) {
            return redirect()->route('catalogo');
        }
    
        $sucursal = \App\Models\Sucursal::findOrFail($request->sucursal_id);
    
        $total = array_sum(array_map(function ($item) {
            return $item['precio'] * $item['cantidad'];
        }, $carrito));
    
        $referencia = session('referencia_pago', 'OXT-' . strtoupper(substr(md5(uniqid()), 0, 8)));
    
        $pedido = Pedido::create([
            'user_id' => auth()->id(),
            'sucursal_id' => $sucursal->id,
            'referencia' => $referencia,
            'total' => $total,
            'estado' => 'Pendiente',
        ]);
    
        foreach ($carrito as $productoId => $item) {
            PedidoDetalle::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $productoId,
                'nombre_producto' => $item['nombre'],
                'precio' => $item['precio'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $item['precio'] * $item['cantidad'],
            ]);
        }
    
        session([
            'pedido_id' => $pedido->id,
            'referencia_pago' => $referencia,
            'sucursal_pedido' => [
                'nombre' => $sucursal->nombre,
                'direccion' => $sucursal->direccion,
            ],
            'total_pedido' => $total,
            'productos_pedido' => $carrito,
        ]);
    
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

        $total     = session('total_pedido', 0);
        $productos = session('productos_pedido', []);

        return view('pedido-confirmado', compact('referencia', 'sucursal', 'total', 'productos'));
    }

  public static function listaSucursales(): array
    {
        return [
            
            1 => [
                'nombre'    => 'OXXO Mall Santa Anita',         
                'distrito'  => 'Santa Anita',        
                'direccion' => 'Av. Nicolás Ayllón S/N, Santa Anita',          
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.056485, 
                'lng'       => -76.970677, 
                'telefono'  => '+51 1 6013636'
            ],
            2 => [
                'nombre'    => 'OXXO Tilos',  
                'distrito'  => 'Santa Anita',                
                'direccion' => 'Av. Colectora Industrial Mz A Lt 1, Santa Anita',                
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.0407002, 
                'lng'       => -76.9601735, 
                'telefono'  => '+51 1 6013636'
            ],
            3 => [
                'nombre'    => 'OXXO Industrial',       
                'distrito'  => 'La Molina',    
                'direccion' => 'Av. Separadora Industrial 1886, La Molina',      
                'horario'   => 'Lun–Vie 6:00 am – 11:00 pm / Sáb-Dom 9:00 am – 11:00 pm',  
                'lat'       => -12.064745, 
                'lng'       => -76.965165, 
                'telefono'  => '+51 1 6013636'
            ],
            4 => [
                'nombre'    => 'OXXO Altamira',         
                'distrito'  => 'La Molina',        
                'direccion' => 'Av. Los Frutales 776, La Molina',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.0681006, 
                'lng'       => -76.9648032, 
                'telefono'  => '+51 1 6013636'
            ],
            5 => [
                'nombre'    => 'OXXO El Sol de La Molina',         
                'distrito'  => 'La Molina',        
                'direccion' => 'Av. La Molina 3614, La Molina',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.0857674, 
                'lng'       => -76.9129866, 
                'telefono'  => 'No disponible'
            ],
            6 => [
                'nombre'    => 'OXXO Ballón',         
                'distrito'  => 'San Borja',        
                'direccion' => 'Av. San Luis 1607, San Borja',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -12.0827678, 
                'lng'       => -76.9969712, 
                'telefono'  => 'No disponible'
            ],
            7 => [
                'nombre'    => 'OXXO Las Artes',         
                'distrito'  => 'San Borja',        
                'direccion' => 'Av. San Luis 2001, San Borja',            
                'horario'   => 'Lun–Dom 7:00 am – 11:00 pm',  
                'lat'       => -12.0900039, 
                'lng'       => -76.9959279, 
                'telefono'  => '+51 1 6013636'
            ],
            8 => [
                'nombre'    => 'OXXO Chimu',         
                'distrito'  => 'San Juan de Lurigancho',        
                'direccion' => 'Av. Gran Chimú 885, San Juan de Lurigancho',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -12.0249189, 
                'lng'       => -76.998796, 
                'telefono'  => '+51 1 6013636'
            ],
            9 => [
                'nombre'    => 'OXXO El Polo',         
                'distrito'  => 'Santiago de Surco',        
                'direccion' => 'Av. El Polo 407, Surco',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -12.1043774, 
                'lng'       => -76.9730304, 
                'telefono'  => '+51 1 6013636'
            ],
            10 => [
                'nombre'    => 'OXXO Cronos',         
                'distrito'  => 'Santiago de Surco',        
                'direccion' => 'Av. El Derby 055, Surco',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.099076, 
                'lng'       => -76.970167, 
                'telefono'  => '+51 1 6013636'
            ],
            11 => [
                'nombre'    => 'Oxxo Manuel Olguin',         
                'distrito'  => 'Santiago de Surco',        
                'direccion' => 'Av. Manuel Olguín 489, Surco',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.0907664, 
                'lng'       => -76.9735879, 
                'telefono'  => 'No disponible'
            ],
            12 => [
                'nombre'    => 'OXXO Panama',         
                'distrito'  => 'San Isidro',        
                'direccion' => 'Av. República de Panamá 3527, San Isidro',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -12.0989769, 
                'lng'       => -77.0194505, 
                'telefono'  => '+51 1 6013636'
            ],
            13 => [
                'nombre'    => 'OXXO Laureles',         
                'distrito'  => 'San Isidro',        
                'direccion' => 'Av. Dos de Mayo 1500, San Isidro',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.092396, 
                'lng'       => -77.0465975, 
                'telefono'  => '+51 1 6013636'
            ],
            14 => [
                'nombre'    => 'OXXO Cáceres',         
                'distrito'  => 'Miraflores',        
                'direccion' => 'Av. Andrés Avelino Cáceres 298, Miraflores',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -12.119832, 
                'lng'       => -77.0213295, 
                'telefono'  => '+51 964 201 270'
            ],
            15 => [
                'nombre'    => 'OXXO Bolívar',         
                'distrito'  => 'Miraflores',        
                'direccion' => 'Calle Bolívar 268, Miraflores',            
                'horario'   => 'Lun–Dom 6:00 am – 9:00 pm',  
                'lat'       => -12.1259102, 
                'lng'       => -77.0273535, 
                'telefono'  => '+51 1 6013636'
            ],

            16 => [
                'nombre'    => 'OXXO Arenales',         
                'distrito'  => 'Lince',        
                'direccion' => 'Av. Arenales 1756, Lince',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.083810, 
                'lng'       => -77.035770, 
                'telefono'  => '+51 1 6013636'
            ],
            17 => [
                'nombre'    => 'OXXO Garzón',         
                'distrito'  => 'Jesús María',        
                'direccion' => 'Av. General Garzón 1282, Jesús María',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -12.073530, 
                'lng'       => -77.046180, 
                'telefono'  => '+51 1 6013636'
            ],
            18 => [
                'nombre'    => 'OXXO Sucre',         
                'distrito'  => 'Pueblo Libre',        
                'direccion' => 'Av. Antonio José de Sucre 745, Pueblo Libre',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.077240, 
                'lng'       => -77.062480, 
                'telefono'  => '+51 1 6013636'
            ],
            19 => [
                'nombre'    => 'OXXO Brasil',         
                'distrito'  => 'Magdalena del Mar',        
                'direccion' => 'Av. Brasil 3396, Magdalena del Mar',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.092490, 
                'lng'       => -77.063230, 
                'telefono'  => '+51 1 6013636'
            ],
            20 => [
                'nombre'    => 'OXXO Escardó',         
                'distrito'  => 'San Miguel',        
                'direccion' => 'Av. Rafael Escardó 398, San Miguel',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -12.078420, 
                'lng'       => -77.087950, 
                'telefono'  => '+51 1 6013636'
            ],
            21 => [
                'nombre'    => 'OXXO Villarán',         
                'distrito'  => 'Surquillo',        
                'direccion' => 'Av. Manuel Villarán 804, Surquillo',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.115860, 
                'lng'       => -77.004240, 
                'telefono'  => '+51 1 6013636'
            ],
            22 => [
                'nombre'    => 'OXXO Grau Barranco',         
                'distrito'  => 'Barranco',        
                'direccion' => 'Av. Almirante Miguel Grau 301, Barranco',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.144410, 
                'lng'       => -77.020290, 
                'telefono'  => '+51 1 6013636'
            ],
            23 => [
                'nombre'    => 'OXXO Mayolo',         
                'distrito'  => 'Los Olivos',        
                'direccion' => 'Av. Antúnez de Mayolo 804, Los Olivos',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -11.996160, 
                'lng'       => -77.076890, 
                'telefono'  => '+51 1 6013636'
            ],
            24 => [
                'nombre'    => 'OXXO Arica',         
                'distrito'  => 'Breña',        
                'direccion' => 'Av. Arica 441, Breña',            
                'horario'   => 'Lun–Dom 6:00 am – 11:00 pm',  
                'lat'       => -12.058340, 
                'lng'       => -77.046910, 
                'telefono'  => '+51 1 6013636'
            ],
            25 => [
                'nombre'    => 'OXXO Habich',         
                'distrito'  => 'San Martín de Porres',        
                'direccion' => 'Av. Eduardo de Habich 190, SMP',            
                'horario'   => 'Abierto 24 horas',  
                'lat'       => -12.019120, 
                'lng'       => -77.042850, 
                'telefono'  => '+51 1 6013636'
            ]
        ];
    }
}
