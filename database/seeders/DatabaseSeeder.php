<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Usuario admin por defecto
        User::firstOrCreate(
            ['email' => 'admin@oxxo.com'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('admin1234'),
                'role'     => 'admin',
            ]
        );

        $this->call([
            CategoriaSeeder::class,
            ProductoSeeder::class,
        ]);
    }
}
