<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            // Bebidas
            'Bebidas' => [
                ['nombre' => 'Agua San Luis 625ml',       'precio' => 1.50, 'stock' => 50],
                ['nombre' => 'Gaseosa Inca Kola 500ml',   'precio' => 2.80, 'stock' => 40],
                ['nombre' => 'Sporade Tropical 500ml',    'precio' => 2.50, 'stock' => 35],
            ],
            // Snacks
            'Snacks' => [
                ['nombre' => 'Papas Lays Clásicas 38g',   'precio' => 2.00, 'stock' => 60],
                ['nombre' => 'Galletas Oreo 6 unidades',  'precio' => 1.80, 'stock' => 55],
                ['nombre' => 'Chifles Inka Crops 50g',    'precio' => 2.20, 'stock' => 45],
            ],
            // Lácteos
            'Lácteos' => [
                ['nombre' => 'Leche Gloria Entera 1L',    'precio' => 5.20, 'stock' => 30],
                ['nombre' => 'Yogurt Laive Fresa 180g',   'precio' => 2.60, 'stock' => 25],
                ['nombre' => 'Queso Fresco Laive 250g',   'precio' => 7.90, 'stock' => 20],
            ],
            // Panadería
            'Panadería' => [
                ['nombre' => 'Pan de Molde Bimbo 500g',   'precio' => 6.50, 'stock' => 20],
                ['nombre' => 'Croissant Mantequilla',     'precio' => 3.00, 'stock' => 15],
                ['nombre' => 'Queque Marmoleado 90g',     'precio' => 2.50, 'stock' => 18],
            ],
            // Higiene
            'Higiene' => [
                ['nombre' => 'Jabón Dove Original 90g',   'precio' => 3.50, 'stock' => 40],
                ['nombre' => 'Champú Head & Shoulders 200ml', 'precio' => 8.90, 'stock' => 25],
                ['nombre' => 'Desodorante Rexona 150ml',  'precio' => 9.50, 'stock' => 30],
            ],
            // Limpieza
            'Limpieza' => [
                ['nombre' => 'Lejía Clorox 500ml',        'precio' => 4.20, 'stock' => 25],
                ['nombre' => 'Detergente Ariel 500g',     'precio' => 7.80, 'stock' => 20],
                ['nombre' => 'Limpiatodo Sapolio 500ml',  'precio' => 5.50, 'stock' => 22],
            ],
        ];

        foreach ($productos as $categoriaNombre => $items) {
            $categoria = Categoria::where('nombre', $categoriaNombre)->first();
            if (!$categoria) continue;

            foreach ($items as $item) {
                Producto::firstOrCreate(
                    ['nombre' => $item['nombre']],
                    array_merge($item, ['categoria_id' => $categoria->id, 'imagen' => null])
                );
            }
        }
    }
}
