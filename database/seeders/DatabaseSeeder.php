<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Llamamos a los seeders en el orden correcto
        $this->call([
            PermisosSeeder::class,
            EtapasSeeder::class,
            EquiposSeeder::class,
            PartidosSeeder::class,
            PreguntasSeeder::class
        ]);
    }
}