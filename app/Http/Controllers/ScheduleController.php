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
            $schedules = Schedule::with(['clinic', 'specialist', 'patient'])->get();
            return response()->json(['data' => $schedules]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter as agendas'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|string|in:Online,Presencial',
                'reason_for_consultation' => 'nullable|string',
                'start_time' => 'required|date_format:Y-m-d\TH:i',
                'end_time' => 'required|date_format:Y-m-d\TH:i|after:hora_inicio',
                'payment' => 'required|string|in:Particular,Convênio',
                'clinic_id' => 'required|integer|exists:clinics,id',
                'specialist_id' => 'required|integer|exists:specialists,id',
                'patient_id' => 'required|integer|exists:patients,id',
            ]);

            $schedule = Schedule::create($request->all());

            return response()->json(['message' => 'Agenda criada com sucesso', 'data' => $schedule], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao criar a agenda', 'message' => $errorMessage], 500);
        }
    }

    public function show($id)
    {
        try {
            $schedule = Schedule::with(['clinic', 'specialist', 'patient'])->findOrFail($id);
            return response()->json(['data' => $schedule]);
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
                'type' => 'required|string|in:Online,Presencial',
                'reason_for_consultation' => 'nullable|string',
                'start_time' => 'required|date_format:Y-m-d\TH:i',
                'end_time' => 'required|date_format:Y-m-d\TH:i|after:hora_inicio',
                'payment' => 'required|string|in:Particular,Convênio',
                'clinic_id' => 'required|integer|exists:clinics,id',
                'specialist_id' => 'required|integer|exists:specialists,id',
                'patient_id' => 'required|integer|exists:patients,id',
            ]);

            $schedule = Schedule::findOrFail($id);
            $schedule->update($request->all());

            return response()->json(['message' => 'Agenda atualizada com sucesso', 'data' => $schedule]);
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
            $schedule = Schedule::findOrFail($id);
            $schedule->delete();
            return response()->json(['message' => 'Agenda deletada com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Agenda não encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar a agenda'], 500);
        }
    }
}