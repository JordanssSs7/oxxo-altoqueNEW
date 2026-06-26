<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');
Route::get('/terminos', fn() => view('terminos'))->name('terminos');
Route::get('/privacidad', fn() => view('privacidad'))->name('privacidad');
Route::get('/promociones', [ProductoController::class, 'promociones'])->name('promociones');
Route::get('/sucursales', function () {
    $sucursales = \App\Http\Controllers\CarritoController::listaSucursales();
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
});

require __DIR__.'/auth.php';
