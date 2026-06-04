<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtapasSeeder extends Seeder
{
    public function run(): void
    {
        $etapas = [
            ['id' => 1, 'nombre' => 'Grupo A'],
            ['id' => 2, 'nombre' => 'Grupo B'],
            ['id' => 3, 'nombre' => 'Grupo C'],
            ['id' => 4, 'nombre' => 'Grupo D'],
            ['id' => 5, 'nombre' => 'Grupo E'],
            ['id' => 6, 'nombre' => 'Grupo F'],
            ['id' => 7, 'nombre' => 'Grupo G'],
            ['id' => 8, 'nombre' => 'Grupo H'],
            ['id' => 9, 'nombre' => 'Grupo I'],
            ['id' => 10, 'nombre' => 'Grupo J'],
            ['id' => 11, 'nombre' => 'Grupo K'],
            ['id' => 12, 'nombre' => 'Grupo L'],
            ['id' => 13, 'nombre' => 'Dieciseisavos'],
            ['id' => 14, 'nombre' => 'Octavos'],
            ['id' => 15, 'nombre' => 'Cuartos'],
            ['id' => 16, 'nombre' => 'Semifinal'],
            ['id' => 17, 'nombre' => 'Tercer Lugar'],
            ['id' => 18, 'nombre' => 'Gran Final'],
        ];

        DB::table('etapas')->insert($etapas);
    }
}