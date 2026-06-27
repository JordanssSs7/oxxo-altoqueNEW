<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalSeeder extends Seeder
{
    public function run(): void
    {
        $sucursales = [
            ['nombre' => 'OXXO Mall Santa Anita',   'distrito' => 'Santa Anita',        'direccion' => 'Av. Los Frutales 1200, Santa Anita',      'horario' => 'Lun–Dom 7:00 am – 11:00 pm',  'lat' => -12.0472, 'lng' => -76.9718, 'telefono' => '(01) 362-1100'],
            ['nombre' => 'OXXO Miraflores',          'distrito' => 'Miraflores',          'direccion' => 'Av. Larco 345, Miraflores',               'horario' => 'Lun–Dom 7:00 am – 11:00 pm',  'lat' => -12.1211, 'lng' => -77.0282, 'telefono' => '(01) 234-5678'],
            ['nombre' => 'OXXO San Isidro',          'distrito' => 'San Isidro',          'direccion' => 'Calle Los Libertadores 120, San Isidro',  'horario' => 'Lun–Dom 6:30 am – 11:30 pm',  'lat' => -12.0964, 'lng' => -77.0432, 'telefono' => '(01) 345-6789'],
            ['nombre' => 'OXXO Surco',               'distrito' => 'Santiago de Surco',   'direccion' => 'Av. Primavera 890, Surco',                'horario' => 'Lun–Dom 7:00 am – 12:00 am',  'lat' => -12.1226, 'lng' => -76.9924, 'telefono' => '(01) 456-7890'],
            ['nombre' => 'OXXO Barranco',            'distrito' => 'Barranco',            'direccion' => 'Av. Grau 210, Barranco',                  'horario' => 'Lun–Dom 8:00 am – 10:00 pm',  'lat' => -12.1491, 'lng' => -77.0219, 'telefono' => '(01) 567-8901'],
            ['nombre' => 'OXXO San Borja',           'distrito' => 'San Borja',           'direccion' => 'Av. San Luis 1850, San Borja',            'horario' => 'Lun–Dom 7:00 am – 11:00 pm',  'lat' => -12.1015, 'lng' => -76.9980, 'telefono' => '(01) 678-9012'],
            ['nombre' => 'OXXO ATE Nicolás Ayllón', 'distrito' => 'ATE',                 'direccion' => 'Av. Nicolás Ayllón 2850, ATE',            'horario' => 'Lun–Dom 6:00 am – 11:30 pm',  'lat' => -12.0256, 'lng' => -76.9401, 'telefono' => '(01) 362-2200'],
            ['nombre' => 'OXXO ATE Vitarte',         'distrito' => 'ATE Vitarte',         'direccion' => 'Carretera Central 4200, ATE Vitarte',     'horario' => 'Lun–Dom 6:00 am – 12:00 am',  'lat' => -12.0218, 'lng' => -76.9120, 'telefono' => '(01) 362-3300'],
            ['nombre' => 'OXXO El Agustino',         'distrito' => 'El Agustino',         'direccion' => 'Av. Riva Agüero 950, El Agustino',        'horario' => 'Lun–Dom 7:00 am – 11:00 pm',  'lat' => -12.0434, 'lng' => -77.0013, 'telefono' => '(01) 362-4400'],
            ['nombre' => 'OXXO San Luis',            'distrito' => 'San Luis',            'direccion' => 'Av. César Vallejo 480, San Luis',         'horario' => 'Lun–Dom 7:00 am – 11:00 pm',  'lat' => -12.0691, 'lng' => -76.9951, 'telefono' => '(01) 362-5500'],
            ['nombre' => 'OXXO ATE Salamanca',       'distrito' => 'ATE (Salamanca)',     'direccion' => 'Av. Circunvalación 1050, Salamanca ATE',  'horario' => 'Lun–Dom 7:00 am – 10:30 pm',  'lat' => -12.0612, 'lng' => -76.9768, 'telefono' => '(01) 362-6600'],
            ['nombre' => 'OXXO La Molina',           'distrito' => 'La Molina',           'direccion' => 'Av. La Molina 300, La Molina',            'horario' => 'Lun–Dom 7:00 am – 11:00 pm',  'lat' => -12.0845, 'lng' => -76.9446, 'telefono' => '(01) 362-7700'],
        ];

        foreach ($sucursales as $data) {
            Sucursal::firstOrCreate(['nombre' => $data['nombre']], array_merge($data, ['activo' => true]));
        }
    }
}
