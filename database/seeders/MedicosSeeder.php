<?php

namespace Database\Seeders;

use App\Models\Medico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicos = [
            ['nome' => 'Aurora Delgado', 'especialidade' => 'Dermatologia', 'cidade_id' => 2],
            ['nome' => 'Cristina Ariane Grego', 'especialidade' => 'Neurologia', 'cidade_id' => 1],
            ['nome' => 'Dayana Mônica Paz', 'especialidade' => 'Oftalmologia', 'cidade_id' => 3],
        ];

        foreach ($medicos as $medico) {
            Medico::create($medico);
        }
    }
}
