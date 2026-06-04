<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            ['id' => 1, 'nombre' => 'Ninguno'],
            ['id' => 2, 'nombre' => 'Jugar'],
            ['id' => 3, 'nombre' => 'Administrar']
        ];

        DB::table('permisos')->insert($permisos);
    }
}