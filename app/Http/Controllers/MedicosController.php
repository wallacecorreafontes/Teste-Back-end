<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
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

    public function getPacientesByMedico($medico_id)
    {
        $nome = request()->get('nome');
        $apenasAgendadas = request()->get('apenas-agendadas', false);

        $medico = Medico::with(['consultas.paciente'])
            ->findOrFail($medico_id);

        $consultas = $medico->consultas()->when($nome, function ($query) use ($nome) {
            $query->whereHas('paciente', function ($subQuery) use ($nome) {
                $subQuery->where('nome', 'LIKE', '%' . $nome . '%');
            });
        });

        if ($apenasAgendadas) {
            $consultas->whereNull('data')->orWhere('data', '>', now());
        }

        $consultas = $consultas->orderBy('data', 'ASC')->get();
        $pacientes = $consultas->pluck('paciente');

        return response()->json($pacientes);
    }

    public function storeConsulta(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'medico_id' => 'required|integer|exists:medicos,id',
                'paciente_id' => 'required|integer|exists:pacientes,id',
                'data' => 'required|date_format:Y-m-d H:i:s',
            ]);

            $consulta = Consulta::create($validated);

            DB::commit();
            return response()->json(['message' => 'Consulta registrado com sucesso', 'response' => $consulta], 201);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
