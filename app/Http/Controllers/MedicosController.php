<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicosController extends Controller
{

    public function index()
    {
        $query = Medico::query();

        $nome = request()->get('nome');

        if ($nome) {
            $nome = preg_replace('/\b(dr|dra)\s+/i', '', $nome);
            $query->where('nome', 'LIKE', '%' . $nome . '%');
        }

        $medicos = $query->orderBy('nome', 'ASC')->get();

        return response()->json($medicos);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'especialidade' => 'required|string|max:255',
                'cidade_id' => 'required|integer|exists:cidades,id',
            ]);

            $medico = Medico::create($validated);

            DB::commit();
            return response()->json(['message' => 'Médico registrado com sucesso', 'response' => $medico], 201);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
