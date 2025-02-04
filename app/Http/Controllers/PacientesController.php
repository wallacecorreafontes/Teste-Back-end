<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'cpf' => 'required|string|max:20',
                'celular' => 'required|string|max:20',
            ]);

            $paciente = Paciente::create($validated);

            DB::commit();
            return response()->json(['message' => 'Paciente registrado com sucesso', 'response' => $paciente], 201);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $paciente_id)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'nome' => 'nullable|string|max:255',
                'cpf' => 'nullable|string|max:20',
                'celular' => 'nullable|string|max:20',
            ]);

            $paciente = Paciente::findOrFail($paciente_id);
            $paciente->update($validated);

            DB::commit();
            return response()->json(['message' => 'Paciente atualizado com sucesso', 'response' => $paciente], 201);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
