<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Bebidas',    'descripcion' => 'Aguas, jugos, gaseosas y energizantes'],
            ['nombre' => 'Snacks',     'descripcion' => 'Papas, galletas y frituras'],
            ['nombre' => 'Lácteos',    'descripcion' => 'Leches, yogures y quesos'],
            ['nombre' => 'Panadería',  'descripcion' => 'Pan, pasteles y bollería'],
            ['nombre' => 'Higiene',    'descripcion' => 'Jabones, champús y cuidado personal'],
            ['nombre' => 'Limpieza',   'descripcion' => 'Detergentes, desinfectantes y artículos del hogar'],
        ];

        foreach ($categorias as $cat) {
            Categoria::firstOrCreate(['nombre' => $cat['nombre']], $cat);
        }
    }
}
