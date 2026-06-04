<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposSeeder extends Seeder
{
    public function run(): void
    {
        $equipos = [
            ['id' => 1, 'nombre' => 'México', 'bandera' => '🇲🇽'],
            ['id' => 2, 'nombre' => 'Sudáfrica', 'bandera' => '🇿🇦'],
            ['id' => 3, 'nombre' => 'Corea del Sur', 'bandera' => '🇰🇷'],
            ['id' => 4, 'nombre' => 'República Checa', 'bandera' => '🇨🇿'],
            ['id' => 5, 'nombre' => 'Canadá', 'bandera' => '🇨🇦'],
            ['id' => 6, 'nombre' => 'Bosnia y Herzegovina', 'bandera' => '🇧🇦'],
            ['id' => 7, 'nombre' => 'Catar', 'bandera' => '🇶🇦'],
            ['id' => 8, 'nombre' => 'Suiza', 'bandera' => '🇨🇭'],
            ['id' => 9, 'nombre' => 'Brasil', 'bandera' => '🇧🇷'],
            ['id' => 10, 'nombre' => 'Marruecos', 'bandera' => '🇲🇦'],
            ['id' => 11, 'nombre' => 'Haití', 'bandera' => '🇭🇹'],
            ['id' => 12, 'nombre' => 'Escocia', 'bandera' => '🏴󠁧󠁢󠁳󠁣󠁴󠁿'],
            ['id' => 13, 'nombre' => 'Estados Unidos', 'bandera' => '🇺🇸'],
            ['id' => 14, 'nombre' => 'Paraguay', 'bandera' => '🇵🇾'],
            ['id' => 15, 'nombre' => 'Australia', 'bandera' => '🇦🇺'],
            ['id' => 16, 'nombre' => 'Turquía', 'bandera' => '🇹🇷'],
            ['id' => 17, 'nombre' => 'Alemania', 'bandera' => '🇩🇪'],
            ['id' => 18, 'nombre' => 'Curazao', 'bandera' => '🇨🇼'],
            ['id' => 19, 'nombre' => 'Costa de Marfil', 'bandera' => '🇨🇮'],
            ['id' => 20, 'nombre' => 'Ecuador', 'bandera' => '🇪🇨'],
            ['id' => 21, 'nombre' => 'Países Bajos', 'bandera' => '🇳🇱'],
            ['id' => 22, 'nombre' => 'Japón', 'bandera' => '🇯🇵'],
            ['id' => 23, 'nombre' => 'Suecia', 'bandera' => '🇸🇪'],
            ['id' => 24, 'nombre' => 'Túnez', 'bandera' => '🇹🇳'],
            ['id' => 25, 'nombre' => 'Bélgica', 'bandera' => '🇧🇪'],
            ['id' => 26, 'nombre' => 'Egipto', 'bandera' => '🇪🇬'],
            ['id' => 27, 'nombre' => 'Irán', 'bandera' => '🇮🇷'],
            ['id' => 28, 'nombre' => 'Nueva Zelanda', 'bandera' => '🇳🇿'],
            ['id' => 29, 'nombre' => 'España', 'bandera' => '🇪🇸'],
            ['id' => 30, 'nombre' => 'Cabo Verde', 'bandera' => '🇨🇻'],
            ['id' => 31, 'nombre' => 'Arabia Saudita', 'bandera' => '🇸🇦'],
            ['id' => 32, 'nombre' => 'Uruguay', 'bandera' => '🇺🇾'],
            ['id' => 33, 'nombre' => 'Francia', 'bandera' => '🇫🇷'],
            ['id' => 34, 'nombre' => 'Senegal', 'bandera' => '🇸🇳'],
            ['id' => 35, 'nombre' => 'Noruega', 'bandera' => '🇳🇴'],
            ['id' => 36, 'nombre' => 'Irak', 'bandera' => '🇮🇶'],
            ['id' => 37, 'nombre' => 'Argentina', 'bandera' => '🇦🇷'],
            ['id' => 38, 'nombre' => 'Argelia', 'bandera' => '🇩🇿'],
            ['id' => 39, 'nombre' => 'Austria', 'bandera' => '🇦🇹'],
            ['id' => 40, 'nombre' => 'Jordania', 'bandera' => '🇯🇴'],
            ['id' => 41, 'nombre' => 'Portugal', 'bandera' => '🇵🇹'],
            ['id' => 42, 'nombre' => 'Uzbekistán', 'bandera' => '🇺🇿'],
            ['id' => 43, 'nombre' => 'Colombia', 'bandera' => '🇨🇴'],
            ['id' => 44, 'nombre' => 'R. D. del Congo', 'bandera' => '🇨🇩'],
            ['id' => 45, 'nombre' => 'Inglaterra', 'bandera' => '🏴󠁧󠁢󠁥󠁮󠁧󠁿'],
            ['id' => 46, 'nombre' => 'Croacia', 'bandera' => '🇭🇷'],
            ['id' => 47, 'nombre' => 'Ghana', 'bandera' => '🇬🇭'],
            ['id' => 48, 'nombre' => 'Panamá', 'bandera' => '🇵🇦'],
        ];

        DB::table('equipos')->insert($equipos);
    }
}