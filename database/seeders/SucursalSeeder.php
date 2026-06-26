<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sucursales = [
            [
                'nombre' => 'OXXO Miraflores',
                'distrito' => 'Miraflores, Lima',
                'direccion' => 'Av. Larco 345, Miraflores',
                'horario' => 'Lun-Dom: 7:00 am - 11:00 pm',
                'telefono' => '(01) 234-5678',
                'estado' => 'Abierto',
            ],
            [
                'nombre' => 'OXXO San Isidro',
                'distrito' => 'San Isidro, Lima',
                'direccion' => 'Calle Los Libertadores 120, San Isidro',
                'horario' => 'Lun-Dom: 6:30 am - 11:30 pm',
                'telefono' => '(01) 345-6789',
                'estado' => 'Abierto',
            ],
            [
                'nombre' => 'OXXO Surco',
                'distrito' => 'Santiago de Surco, Lima',
                'direccion' => 'Av. Primavera 890, Surco',
                'horario' => 'Lun-Dom: 7:00 am - 12:00 am',
                'telefono' => '(01) 456-7890',
                'estado' => 'Abierto',
            ],
            [
                'nombre' => 'OXXO Barranco',
                'distrito' => 'Barranco, Lima',
                'direccion' => 'Av. Grau 210, Barranco',
                'horario' => 'Lun-Dom: 8:00 am - 10:00 pm',
                'telefono' => '(01) 567-8901',
                'estado' => 'Abierto',
            ],
            [
                'nombre' => 'OXXO San Borja',
                'distrito' => 'San Borja, Lima',
                'direccion' => 'Av. San Luis 1850, San Borja',
                'horario' => 'Lun-Dom: 7:00 am - 11:00 pm',
                'telefono' => '(01) 678-9012',
                'estado' => 'Abierto',
            ],
            [
                'nombre' => 'OXXO La Molina',
                'distrito' => 'La Molina, Lima',
                'direccion' => 'Av. La Molina 560, La Molina',
                'horario' => 'Lun-Dom: 7:00 am - 11:00 pm',
                'telefono' => null,
                'estado' => 'Proximamente',
            ],
        ];

        foreach ($sucursales as $sucursal) {
            Sucursal::firstOrCreate(
                ['nombre' => $sucursal['nombre']],
                $sucursal
            );
        }
    }
}