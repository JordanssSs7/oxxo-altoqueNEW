<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['user', 'sucursal'])
            ->latest()
            ->get();

        return view('pedidos_admin.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        $pedido->load(['user', 'sucursal', 'detalles']);

        return view('pedidos_admin.show', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,Listo,Entregado,Cancelado',
        ]);

        $pedido->update([
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.pedidos.show', $pedido)
            ->with('success', 'Estado del pedido actualizado correctamente.');
    }
}