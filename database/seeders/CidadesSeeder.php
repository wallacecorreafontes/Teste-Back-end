<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cidades = [
            ['nome' => 'Curitiba', 'estado' => 'PR'],
            ['nome' => 'Pelotas', 'estado' => 'RS'],
            ['nome' => 'São Paulo', 'estado' => 'SP'],
        ];

        foreach ($cidades as $cidade) {
            Cidade::create($cidade);
        }
    }
}
