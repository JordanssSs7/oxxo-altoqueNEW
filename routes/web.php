<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SucursalController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\Admin\PedidoController as AdminPedidoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');
Route::get('/terminos', fn() => view('terminos'))->name('terminos');
Route::get('/privacidad', fn() => view('privacidad'))->name('privacidad');
Route::get('/sucursales', function () {
    $sucursales = \App\Models\Sucursal::where('activo', true)->orderBy('nombre')->get();
    return view('sucursales', compact('sucursales'));
})->name('sucursales');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/foto', [ProfileController::class, 'actualizarFoto'])->name('profile.foto');
    Route::get('/mis-pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/mis-pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/quitar', [CarritoController::class, 'quitar'])->name('carrito.quitar');
    Route::post('/carrito/incrementar', [CarritoController::class, 'incrementar'])->name('carrito.incrementar');
    Route::post('/carrito/decrementar', [CarritoController::class, 'decrementar'])->name('carrito.decrementar');
    Route::get('/pago', [CarritoController::class, 'pago'])->name('carrito.pago');
    Route::post('/pedido-confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    Route::get('/pedido-confirmado', [CarritoController::class, 'confirmado'])->name('carrito.confirmado');
});

// Rutas del administrador — protegidas con auth y es.admin
Route::middleware(['auth', 'es.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('sucursales', SucursalController::class);
    Route::get('/pedidos', [AdminPedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [AdminPedidoController::class, 'show'])->name('pedidos.show');
    Route::put('/pedidos/{pedido}', [AdminPedidoController::class, 'update'])->name('pedidos.update');
});

require __DIR__.'/auth.php';
