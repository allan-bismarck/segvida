<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\Image;

class SpecialtyController extends Controller
{
    public function index()
    {
        try {
            $specialties = Specialty::all();
            return response()->json($specialties);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter as especialidades.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $specialty = Specialty::findOrFail($id);
            return response()->json($specialty);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Especialidade não encontrada.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter a especialidade.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'color' => 'nullable|string|max:255',
                'photo' => 'nullable|integer',
            ]);

            $specialty = Specialty::create($request->all());

            $imageId = null;

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $specialty->id, 'specialty');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->imagem->id;
                }
            }

            if ($imageId != null) {
                $specialty->photo = $imageId;
            }

            $specialty->save();
            return response()->json(['message' => 'Especialidade cadastrada com sucesso.', 'data' => $specialty], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao criar a especialidade.', 'message' => $errorMessage], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'color' => 'nullable|string|max:255',
                'photo' => 'nullable|integer',
            ]);

            $specialty = Specialty::findOrFail($id);

            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $specialty->id, 'specialty');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->image->id;

                    if ($specialty->photo) {
                        Image::destroy($specialty->photo);
                    }

                    $specialty->photo = $imageId;
                } else {
                    throw new \Exception('Falha ao fazer upload da imagem.');
                }
            } else {
                if ($specialty->photo) {
                    Image::destroy($specialty->photo);
                    $specialty->photo = null;
                }
            }

            $specialty->update($request->all());

            return response()->json(['message' => 'Especialidade atualizada com sucesso.', 'data' => $specialty], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Especialidade não encontrada.'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao atualizar a especialidade.', 'message' => $errorMessage], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $specialty = Specialty::findOrFail($id);

            if ($specialty->photo) {
                Image::destroy($specialty->photo);
            }

            $specialty->delete();
            return response()->json(['message' => 'Especialidade deletada com sucesso', 'id' => $id], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Especialidade não encontrada.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar a especialidade.'], 500);
        }
    }
}