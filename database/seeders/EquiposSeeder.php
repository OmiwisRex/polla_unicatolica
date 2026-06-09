<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposSeeder extends Seeder
{
    public function run(): void
    {
        $equipos = [
            ['id' => 1, 'nombre' => 'México', 'bandera' => 'mx'],
            ['id' => 2, 'nombre' => 'Sudáfrica', 'bandera' => 'za'],
            ['id' => 3, 'nombre' => 'Corea del Sur', 'bandera' => 'kr'],
            ['id' => 4, 'nombre' => 'República Checa', 'bandera' => 'cz'],
            ['id' => 5, 'nombre' => 'Canadá', 'bandera' => 'ca'],
            ['id' => 6, 'nombre' => 'Bosnia y Herzegovina', 'bandera' => 'ba'],
            ['id' => 7, 'nombre' => 'Catar', 'bandera' => 'qa'],
            ['id' => 8, 'nombre' => 'Suiza', 'bandera' => 'ch'],
            ['id' => 9, 'nombre' => 'Brasil', 'bandera' => 'br'],
            ['id' => 10, 'nombre' => 'Marruecos', 'bandera' => 'ma'],
            ['id' => 11, 'nombre' => 'Haití', 'bandera' => 'ht'],
            ['id' => 12, 'nombre' => 'Escocia', 'bandera' => 'gb-sct'],
            ['id' => 13, 'nombre' => 'Estados Unidos', 'bandera' => 'us'],
            ['id' => 14, 'nombre' => 'Paraguay', 'bandera' => 'py'],
            ['id' => 15, 'nombre' => 'Australia', 'bandera' => 'au'],
            ['id' => 16, 'nombre' => 'Turquía', 'bandera' => 'tr'],
            ['id' => 17, 'nombre' => 'Alemania', 'bandera' => 'de'],
            ['id' => 18, 'nombre' => 'Curazao', 'bandera' => 'cw'],
            ['id' => 19, 'nombre' => 'Costa de Marfil', 'bandera' => 'ci'],
            ['id' => 20, 'nombre' => 'Ecuador', 'bandera' => 'ec'],
            ['id' => 21, 'nombre' => 'Países Bajos', 'bandera' => 'nl'],
            ['id' => 22, 'nombre' => 'Japón', 'bandera' => 'jp'],
            ['id' => 23, 'nombre' => 'Suecia', 'bandera' => 'se'],
            ['id' => 24, 'nombre' => 'Túnez', 'bandera' => 'tn'],
            ['id' => 25, 'nombre' => 'Bélgica', 'bandera' => 'be'],
            ['id' => 26, 'nombre' => 'Egipto', 'bandera' => 'eg'],
            ['id' => 27, 'nombre' => 'Irán', 'bandera' => 'ir'],
            ['id' => 28, 'nombre' => 'Nueva Zelanda', 'bandera' => 'nz'],
            ['id' => 29, 'nombre' => 'España', 'bandera' => 'es'],
            ['id' => 30, 'nombre' => 'Cabo Verde', 'bandera' => 'cv'],
            ['id' => 31, 'nombre' => 'Arabia Saudita', 'bandera' => 'sa'],
            ['id' => 32, 'nombre' => 'Uruguay', 'bandera' => 'uy'],
            ['id' => 33, 'nombre' => 'Francia', 'bandera' => 'fr'],
            ['id' => 34, 'nombre' => 'Senegal', 'bandera' => 'sn'],
            ['id' => 35, 'nombre' => 'Noruega', 'bandera' => 'no'],
            ['id' => 36, 'nombre' => 'Irak', 'bandera' => 'iq'],
            ['id' => 37, 'nombre' => 'Argentina', 'bandera' => 'ar'],
            ['id' => 38, 'nombre' => 'Argelia', 'bandera' => 'dz'],
            ['id' => 39, 'nombre' => 'Austria', 'bandera' => 'at'],
            ['id' => 40, 'nombre' => 'Jordania', 'bandera' => 'jo'],
            ['id' => 41, 'nombre' => 'Portugal', 'bandera' => 'pt'],
            ['id' => 42, 'nombre' => 'Uzbekistán', 'bandera' => 'uz'],
            ['id' => 43, 'nombre' => 'Colombia', 'bandera' => 'co'],
            ['id' => 44, 'nombre' => 'R. D. del Congo', 'bandera' => 'cd'],
            ['id' => 45, 'nombre' => 'Inglaterra', 'bandera' => 'gb-eng'],
            ['id' => 46, 'nombre' => 'Croacia', 'bandera' => 'hr'],
            ['id' => 47, 'nombre' => 'Ghana', 'bandera' => 'gh'],
            ['id' => 48, 'nombre' => 'Panamá', 'bandera' => 'pa'],
        ];

        DB::table('equipos')->insert($equipos);
    }
}
