<?php

namespace Database\Seeders;

use App\Models\Consulta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultas = [
            ['medico_id' => 1, 'paciente_id' => 1, 'data' => '2025-01-29 09:30:00'],
            ['medico_id' => 2, 'paciente_id' => 2, 'data' => '2025-01-30 14:30:00'],
            ['medico_id' => 3, 'paciente_id' => 3, 'data' => '2025-01-29 11:00:00'],
        ];

        foreach ($consultas as $consulta) {
            Consulta::create($consulta);
        }
    }
}
