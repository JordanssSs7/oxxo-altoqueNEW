<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Sucursal::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $sucursales = [
            ['nombre' => 'OXXO Mall Santa Anita',       'distrito' => 'Santa Anita',              'direccion' => 'Av. Nicolás Ayllón S/N, Santa Anita',                  'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.056485,   'lng' => -76.970677,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Tilos',                   'distrito' => 'Santa Anita',              'direccion' => 'Av. Colectora Industrial Mz A Lt 1, Santa Anita',      'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.0407002,  'lng' => -76.9601735, 'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Industrial',              'distrito' => 'La Molina',                'direccion' => 'Av. Separadora Industrial 1886, La Molina',            'horario' => 'Lun–Vie 6:00 am – 11:00 pm / Sáb-Dom 9:00 am – 11:00 pm', 'lat' => -12.064745, 'lng' => -76.965165,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Altamira',                'distrito' => 'La Molina',                'direccion' => 'Av. Los Frutales 776, La Molina',                      'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.0681006,  'lng' => -76.9648032, 'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO El Sol de La Molina',    'distrito' => 'La Molina',                'direccion' => 'Av. La Molina 3614, La Molina',                        'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.0857674,  'lng' => -76.9129866, 'telefono' => 'No disponible'],
            ['nombre' => 'OXXO Ballón',                  'distrito' => 'San Borja',                'direccion' => 'Av. San Luis 1607, San Borja',                         'horario' => 'Abierto 24 horas',                                    'lat' => -12.0827678,  'lng' => -76.9969712, 'telefono' => 'No disponible'],
            ['nombre' => 'OXXO Las Artes',               'distrito' => 'San Borja',                'direccion' => 'Av. San Luis 2001, San Borja',                         'horario' => 'Lun–Dom 7:00 am – 11:00 pm',                          'lat' => -12.0900039,  'lng' => -76.9959279, 'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Chimu',                   'distrito' => 'San Juan de Lurigancho',   'direccion' => 'Av. Gran Chimú 885, San Juan de Lurigancho',            'horario' => 'Abierto 24 horas',                                    'lat' => -12.0249189,  'lng' => -76.998796,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO El Polo',                 'distrito' => 'Santiago de Surco',        'direccion' => 'Av. El Polo 407, Surco',                               'horario' => 'Abierto 24 horas',                                    'lat' => -12.1043774,  'lng' => -76.9730304, 'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Cronos',                  'distrito' => 'Santiago de Surco',        'direccion' => 'Av. El Derby 055, Surco',                              'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.099076,   'lng' => -76.970167,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Manuel Olguin',           'distrito' => 'Santiago de Surco',        'direccion' => 'Av. Manuel Olguín 489, Surco',                         'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.0907664,  'lng' => -76.9735879, 'telefono' => 'No disponible'],
            ['nombre' => 'OXXO Panama',                  'distrito' => 'San Isidro',               'direccion' => 'Av. República de Panamá 3527, San Isidro',             'horario' => 'Abierto 24 horas',                                    'lat' => -12.0989769,  'lng' => -77.0194505, 'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Laureles',                'distrito' => 'San Isidro',               'direccion' => 'Av. Dos de Mayo 1500, San Isidro',                     'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.092396,   'lng' => -77.0465975, 'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Cáceres',                 'distrito' => 'Miraflores',               'direccion' => 'Av. Andrés Avelino Cáceres 298, Miraflores',           'horario' => 'Abierto 24 horas',                                    'lat' => -12.119832,   'lng' => -77.0213295, 'telefono' => '+51 964 201 270'],
            ['nombre' => 'OXXO Bolívar',                 'distrito' => 'Miraflores',               'direccion' => 'Calle Bolívar 268, Miraflores',                        'horario' => 'Lun–Dom 6:00 am – 9:00 pm',                           'lat' => -12.1259102,  'lng' => -77.0273535, 'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Arenales',                'distrito' => 'Lince',                    'direccion' => 'Av. Arenales 1756, Lince',                             'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.083810,   'lng' => -77.035770,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Garzón',                  'distrito' => 'Jesús María',              'direccion' => 'Av. General Garzón 1282, Jesús María',                 'horario' => 'Abierto 24 horas',                                    'lat' => -12.073530,   'lng' => -77.046180,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Sucre',                   'distrito' => 'Pueblo Libre',             'direccion' => 'Av. Antonio José de Sucre 745, Pueblo Libre',          'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.077240,   'lng' => -77.062480,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Brasil',                  'distrito' => 'Magdalena del Mar',        'direccion' => 'Av. Brasil 3396, Magdalena del Mar',                   'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.092490,   'lng' => -77.063230,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Escardó',                 'distrito' => 'San Miguel',               'direccion' => 'Av. Rafael Escardó 398, San Miguel',                   'horario' => 'Abierto 24 horas',                                    'lat' => -12.078420,   'lng' => -77.087950,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Villarán',                'distrito' => 'Surquillo',                'direccion' => 'Av. Manuel Villarán 804, Surquillo',                   'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.115860,   'lng' => -77.004240,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Grau Barranco',           'distrito' => 'Barranco',                 'direccion' => 'Av. Almirante Miguel Grau 301, Barranco',              'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.144410,   'lng' => -77.020290,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Mayolo',                  'distrito' => 'Los Olivos',               'direccion' => 'Av. Antúnez de Mayolo 804, Los Olivos',                'horario' => 'Abierto 24 horas',                                    'lat' => -11.996160,   'lng' => -77.076890,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Arica',                   'distrito' => 'Breña',                    'direccion' => 'Av. Arica 441, Breña',                                 'horario' => 'Lun–Dom 6:00 am – 11:00 pm',                          'lat' => -12.058340,   'lng' => -77.046910,  'telefono' => '+51 1 6013636'],
            ['nombre' => 'OXXO Habich',                  'distrito' => 'San Martín de Porres',     'direccion' => 'Av. Eduardo de Habich 190, SMP',                       'horario' => 'Abierto 24 horas',                                    'lat' => -12.019120,   'lng' => -77.042850,  'telefono' => '+51 1 6013636'],
        ];

        foreach ($sucursales as $data) {
            Sucursal::create(array_merge($data, ['activo' => true]));
        }
    }
}
