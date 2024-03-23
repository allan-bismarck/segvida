<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ScheduleController extends Controller
{
    public function index()
    {
        try {
            $agendas = Schedule::all();
            return response()->json(['data' => $agendas]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter as agendas'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipo' => 'required|string|in:Online,Presencial',
                'motivo_consulta' => 'nullable|string',
                'hora_inicio' => 'required|date_format:Y-m-d\TH:i',
                'hora_fim' => 'required|date_format:Y-m-d\TH:i|after:hora_inicio',
                'pagamento' => 'required|string|in:Particular,Convênio',
                'clinica' => 'required|integer',
                'especialista' => 'required|integer',
                'paciente' => 'required|integer',
            ]);

            $agenda = Schedule::create($request->all());

            return response()->json(['message' => 'Agenda criada com sucesso', 'data' => $agenda], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar a agenda'], 500);
        }
    }

    public function show($id)
    {
        try {
            $agenda = Schedule::findOrFail($id);
            return response()->json(['data' => $agenda]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Agenda não encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter a agenda'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tipo' => 'required|string|in:Online,Presencial',
                'motivo_consulta' => 'nullable|string',
                'hora_inicio' => 'required|date_format:Y-m-d\TH:i',
                'hora_fim' => 'required|date_format:Y-m-d\TH:i|after:hora_inicio',
                'pagamento' => 'required|string|in:Particular,Convênio',
                'clinica' => 'required|integer',
                'especialista' => 'required|integer',
                'paciente' => 'required|integer',
            ]);

            $agenda = Schedule::findOrFail($id);
            $agenda->update($request->all());

            return response()->json(['message' => 'Agenda atualizada com sucesso', 'data' => $agenda]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Agenda não encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar a agenda'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $agenda = Schedule::findOrFail($id);
            $agenda->delete();
            return response()->json(['message' => 'Agenda deletada com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Agenda não encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar a agenda'], 500);
        }
    }
}