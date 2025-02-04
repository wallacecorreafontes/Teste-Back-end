<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacientes = [
            ['nome' => 'Luana Rodrigues', 'cpf' => '662.669.840-08', 'celular' => '(11) 9 8484-6363'],
            ['nome' => 'Luiza Gonçalves', 'cpf' => '491.075.050-94', 'celular' => '(11) 9 8123-4567'],
            ['nome' => 'Raul da Costa', 'cpf' => '323.962.920-80', 'celular' => '(11) 9 9876-5432'],
        ];

        foreach ($pacientes as $paciente) {
            Paciente::create($paciente);
        }
    }
}
