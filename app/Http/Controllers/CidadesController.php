<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    public function index()
    {
        $query = Cidade::query();

        $nome = request()->get('nome');

        if ($nome) {
            $query->where('nome', 'LIKE', '%' . $nome . '%');
        }

        $cidades = $query->orderBy('nome', 'ASC')->get();
        return response()->json($cidades);
    }

    public function getMedicosByCidades($cidade_id)
    {
        $query = Cidade::query()->with(['medicos' => function ($medicosQuery) {
            $nome = request()->get('nome');

            if ($nome) {
                $nome = preg_replace('/\b(dr|dra)\s+/i', '', $nome);
                $medicosQuery->where('nome', 'LIKE', '%' . $nome . '%');
            }
        }]);

        $query->where('id', $cidade_id);

        $cidade = $query->first();

        if (!$cidade) {
            return response()->json(['message' => 'Cidade não encontrada'], 404);
        }
        
        return response()->json($cidade->medicos);
    }
}
