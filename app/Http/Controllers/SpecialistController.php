<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\Image;

class SpecialistController extends Controller
{
    public function index()
    {
        try {
            $specialists = Specialist::all();
            return response()->json($specialists, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter os especialistas.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'CRM' => 'nullable|string',
                'genero' => 'nullable|string|in:Masculino,Feminino',
                'agenda' => 'nullable|array',
                'disponibilidades' => 'nullable|array',
                'foto' => 'nullable|integer',
                'especialidade' => 'nullable|integer' 
            ]);

            $specialist = Specialist::create($request->all());

            $imageId = null;

            if ($request->hasFile('imagem')) {
                $request->validate([
                    'imagem' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $specialist->id, 'specialist');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->imagem->id;
                }
            }

            if ($imageId != null) {
                $specialist->foto = $imageId;
            }

            $specialist->save();
            return response()->json($specialist, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao criar o especialista.', 'message' => $errorMessage], 500);
        }
    }

    public function show($id)
    {
        try {
            $specialist = Specialist::findOrFail($id);
            return response()->json($specialist, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Especialista não encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter o especialista.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'CRM' => 'required|string',
                'genero' => 'required|string|in:Masculino,Feminino',
                'agenda' => 'nullable|array',
                'disponibilidade' => 'nullable|array',
                'foto' => 'nullable|integer',
                'especialidade' => 'nullable|integer' 
            ]);

            $specialist = Specialist::findOrFail($id);

            if ($request->hasFile('imagem')) {
                $request->validate([
                    'imagem' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $specialist->id, 'specialist');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->imagem->id;

                    if ($specialist->foto) {
                        Image::destroy($specialist->foto);
                    }

                    $specialist->foto = $imageId;
                } else {
                    throw new \Exception('Falha ao fazer upload da imagem.');
                }
            } else {
                if ($specialist->foto) {
                    Image::destroy($specialist->foto);
                    $specialist->foto = null;
                }
            }

            $specialist->update($request->all());
            return response()->json($specialist, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Especialista não encontrado.'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao atualizar o especialista.', 'message' => $errorMessage], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $specialist = Specialist::findOrFail($id);

            if ($specialist->foto) {
                Image::destroy($specialist->foto);
            }

            $specialist->delete();
            return response()->json(['message' => 'Especialista deletado com sucesso.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Especialista não encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar o especialista.'], 500);
        }
    }
}