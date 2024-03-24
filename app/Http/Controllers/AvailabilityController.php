<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class AvailabilityController extends Controller
{
    public function index()
    {
        try {
            $availabilities = Availability::with(['clinic', 'specialist'])->get();
            return response()->json($availabilities);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter as disponibilidades.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $availability = Availability::with(['clinic', 'specialist'])->findOrFail($id);
            return response()->json($availability);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Disponibilidade não encontrada.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter a disponibilidade.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'horario_chegada' => 'required|date_format:H:i:s',
                'horario_saida' => 'nullable|date_format:H:i:s',
                'dia' => 'required|string|max:3',
                'clinic_id' => 'required|integer|exists:clinics,id',
                'specialist_id' => 'required|integer|exists:specialists,id'
            ]);

            $availability = Availability::create($request->all());

            return response()->json($availability, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao criar a disponibilidade.', 'message' => $errorMessage], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'horario_chegada' => 'required|date_format:H:i:s',
                'horario_saida' => 'nullable|date_format:H:i:s',
                'dia' => 'required|string|max:3',
                'clinic_id' => 'required|integer|exists:clinics,id',
                'specialist_id' => 'required|integer|exists:specialists,id'
            ]);

            $availability = Availability::findOrFail($id);
            $availability->update($request->all());
            return response()->json($availability);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Disponibilidade não encontrada.'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar a disponibilidade.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $availability = Availability::findOrFail($id);
            $availability->delete();
            return response()->json(['message' => 'Disponibilidade deletada com sucesso.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Disponibilidade não encontrada.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar a disponibilidade.'], 500);
        }
    }

}
