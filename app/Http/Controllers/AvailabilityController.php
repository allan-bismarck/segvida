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
            $disponibilidades = Availability::all();
            return response()->json($disponibilidades);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter as disponibilidades.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $disponibilidade = Availability::findOrFail($id);
            return response()->json($disponibilidade);
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
                'clinica' => 'nullable|integer'
            ]);

            $disponibilidade = Availability::create($request->all());
            return response()->json($disponibilidade, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            print($e);
            return response()->json(['error' => 'Erro ao criar a disponibilidade.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'horario_chegada' => 'required|date_format:H:i:s',
                'horario_saida' => 'required|date_format:H:i:s',
                'dia' => 'required|string|max:3',
                'clinica' => 'nullable|integer'
            ]);

            $disponibilidade = Availability::findOrFail($id);
            $disponibilidade->update($request->all());
            return response()->json($disponibilidade);
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
            $disponibilidade = Availability::findOrFail($id);
            $disponibilidade->delete();
            return response()->json(['message' => 'Disponibilidade deletada com sucesso.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Disponibilidade não encontrada.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar a disponibilidade.'], 500);
        }
    }

}
