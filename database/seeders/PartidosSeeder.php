<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartidosSeeder extends Seeder
{
    public function run(): void
    {
        $partidos = [
            // GRUPO A (Equipos: 1, 2, 3, 4)
            ['etapa_id' => 1, 'equipo_a_id' => 1, 'equipo_b_id' => 2, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 1, 'equipo_a_id' => 3, 'equipo_b_id' => 4, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 1, 'equipo_a_id' => 1, 'equipo_b_id' => 3, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 1, 'equipo_a_id' => 4, 'equipo_b_id' => 2, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 1, 'equipo_a_id' => 4, 'equipo_b_id' => 1, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 1, 'equipo_a_id' => 2, 'equipo_b_id' => 3, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO B (Equipos: 5, 6, 7, 8)
            ['etapa_id' => 2, 'equipo_a_id' => 5, 'equipo_b_id' => 6, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 2, 'equipo_a_id' => 7, 'equipo_b_id' => 8, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 2, 'equipo_a_id' => 5, 'equipo_b_id' => 7, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 2, 'equipo_a_id' => 8, 'equipo_b_id' => 6, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 2, 'equipo_a_id' => 8, 'equipo_b_id' => 5, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 2, 'equipo_a_id' => 6, 'equipo_b_id' => 7, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO C (Equipos: 9, 10, 11, 12)
            ['etapa_id' => 3, 'equipo_a_id' => 9, 'equipo_b_id' => 10, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 3, 'equipo_a_id' => 11, 'equipo_b_id' => 12, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 3, 'equipo_a_id' => 9, 'equipo_b_id' => 11, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 3, 'equipo_a_id' => 12, 'equipo_b_id' => 10, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 3, 'equipo_a_id' => 12, 'equipo_b_id' => 9, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 3, 'equipo_a_id' => 10, 'equipo_b_id' => 11, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO D (Equipos: 13, 14, 15, 16)
            ['etapa_id' => 4, 'equipo_a_id' => 13, 'equipo_b_id' => 14, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 4, 'equipo_a_id' => 15, 'equipo_b_id' => 16, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 4, 'equipo_a_id' => 13, 'equipo_b_id' => 15, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 4, 'equipo_a_id' => 16, 'equipo_b_id' => 14, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 4, 'equipo_a_id' => 16, 'equipo_b_id' => 13, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 4, 'equipo_a_id' => 14, 'equipo_b_id' => 15, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO E (Equipos: 17, 18, 19, 20)
            ['etapa_id' => 5, 'equipo_a_id' => 17, 'equipo_b_id' => 18, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 5, 'equipo_a_id' => 19, 'equipo_b_id' => 20, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 5, 'equipo_a_id' => 17, 'equipo_b_id' => 19, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 5, 'equipo_a_id' => 20, 'equipo_b_id' => 18, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 5, 'equipo_a_id' => 20, 'equipo_b_id' => 17, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 5, 'equipo_a_id' => 18, 'equipo_b_id' => 19, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO F (Equipos: 21, 22, 23, 24)
            ['etapa_id' => 6, 'equipo_a_id' => 21, 'equipo_b_id' => 22, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 6, 'equipo_a_id' => 23, 'equipo_b_id' => 24, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 6, 'equipo_a_id' => 21, 'equipo_b_id' => 23, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 6, 'equipo_a_id' => 24, 'equipo_b_id' => 22, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 6, 'equipo_a_id' => 24, 'equipo_b_id' => 21, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 6, 'equipo_a_id' => 22, 'equipo_b_id' => 23, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO G (Equipos: 25, 26, 27, 28)
            ['etapa_id' => 7, 'equipo_a_id' => 25, 'equipo_b_id' => 26, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 7, 'equipo_a_id' => 27, 'equipo_b_id' => 28, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 7, 'equipo_a_id' => 25, 'equipo_b_id' => 27, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 7, 'equipo_a_id' => 28, 'equipo_b_id' => 26, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 7, 'equipo_a_id' => 28, 'equipo_b_id' => 25, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 7, 'equipo_a_id' => 26, 'equipo_b_id' => 27, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO H (Equipos: 29, 30, 31, 32)
            ['etapa_id' => 8, 'equipo_a_id' => 29, 'equipo_b_id' => 30, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 8, 'equipo_a_id' => 31, 'equipo_b_id' => 32, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 8, 'equipo_a_id' => 29, 'equipo_b_id' => 31, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 8, 'equipo_a_id' => 32, 'equipo_b_id' => 30, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 8, 'equipo_a_id' => 32, 'equipo_b_id' => 29, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 8, 'equipo_a_id' => 30, 'equipo_b_id' => 31, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO I (Equipos: 33, 34, 35, 36)
            ['etapa_id' => 9, 'equipo_a_id' => 33, 'equipo_b_id' => 34, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 9, 'equipo_a_id' => 35, 'equipo_b_id' => 36, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 9, 'equipo_a_id' => 33, 'equipo_b_id' => 35, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 9, 'equipo_a_id' => 36, 'equipo_b_id' => 34, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 9, 'equipo_a_id' => 36, 'equipo_b_id' => 33, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 9, 'equipo_a_id' => 34, 'equipo_b_id' => 35, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO J (Equipos: 37, 38, 39, 40)
            ['etapa_id' => 10, 'equipo_a_id' => 37, 'equipo_b_id' => 38, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 10, 'equipo_a_id' => 39, 'equipo_b_id' => 40, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 10, 'equipo_a_id' => 37, 'equipo_b_id' => 39, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 10, 'equipo_a_id' => 40, 'equipo_b_id' => 38, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 10, 'equipo_a_id' => 40, 'equipo_b_id' => 37, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 10, 'equipo_a_id' => 38, 'equipo_b_id' => 39, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO K (Equipos: 41, 42, 43, 44)
            ['etapa_id' => 11, 'equipo_a_id' => 41, 'equipo_b_id' => 42, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 11, 'equipo_a_id' => 43, 'equipo_b_id' => 44, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 11, 'equipo_a_id' => 41, 'equipo_b_id' => 43, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 11, 'equipo_a_id' => 44, 'equipo_b_id' => 42, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 11, 'equipo_a_id' => 44, 'equipo_b_id' => 41, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 11, 'equipo_a_id' => 42, 'equipo_b_id' => 43, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRUPO L (Equipos: 45, 46, 47, 48)
            ['etapa_id' => 12, 'equipo_a_id' => 45, 'equipo_b_id' => 46, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 12, 'equipo_a_id' => 47, 'equipo_b_id' => 48, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 12, 'equipo_a_id' => 45, 'equipo_b_id' => 47, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 12, 'equipo_a_id' => 48, 'equipo_b_id' => 46, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 12, 'equipo_a_id' => 48, 'equipo_b_id' => 45, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 12, 'equipo_a_id' => 46, 'equipo_b_id' => 47, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // DIECISEISAVOS DE FINAL (16 partidos, etapa_id = 13)
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 13, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // OCTAVOS DE FINAL (8 partidos, etapa_id = 14)
            ['etapa_id' => 14, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 14, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 14, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 14, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 14, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 14, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 14, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 14, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // CUARTOS DE FINAL (4 partidos, etapa_id = 15)
            ['etapa_id' => 15, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 15, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 15, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 15, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // SEMIFINAL (2 partidos, etapa_id = 16)
            ['etapa_id' => 16, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
            ['etapa_id' => 16, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // TERCER LUGAR (1 partido, etapa_id = 17)
            ['etapa_id' => 17, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],

            // GRAN FINAL (1 partido, etapa_id = 18)
            ['etapa_id' => 18, 'equipo_a_id' => null, 'equipo_b_id' => null, 'fecha_hora' => null, 'goles_a' => null, 'goles_b' => null],
        ];

        DB::table('partidos')->insert($partidos);
    }
}