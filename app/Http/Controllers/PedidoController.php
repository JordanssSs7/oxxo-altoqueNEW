<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('sucursal')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        if ($pedido->user_id !== auth()->id()) {
            abort(403);
        }

        $pedido->load(['sucursal', 'detalles']);

        return view('pedidos.show', compact('pedido'));
    }
}