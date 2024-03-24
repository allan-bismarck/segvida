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
            $specialists = Specialist::with(['specialty', 'schedules', 'availabilities'])->get();
            $specialists->each(function ($specialist) {
                $specialist->especialidade->each(function ($specialty) {
                    $specialty->specialist_specialty = $specialty->pivot->toArray();
                    unset($specialty->pivot);
                });
            });

            return response()->json($specialists, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter os especialistas.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'CRM' => 'nullable|string',
                'sex' => 'nullable|string|in:Masculino,Feminino',
                'photo' => 'nullable|integer',
                'specialty' => 'nullable|array',
                'specialty.*' => 'exists:specialties,id'
            ]);

            $specialist = Specialist::create($request->all());

            $specialties = $request->has('specialty') ? $request->input('specialty') : [];

            $specialist->specialty()->sync($specialties);

            $imageId = null;

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $specialist->id, 'specialist');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->image->id;
                }
            }

            if ($imageId != null) {
                $specialist->photo = $imageId;
            }

            if ($specialist->specialty) {
                $specialist->specialty->each(function ($specialty) {
                    $specialty->specialist_specialty = $specialty->pivot->toArray();
                    unset($specialty->pivot);
                });
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
            $specialist = Specialist::with(['specialty', 'schedules', 'availabilities'])->findOrFail($id);

            if ($specialist->specialty) {
                $specialist->specialty->each(function ($specialty) {
                    $specialty->specialist_specialty = $specialty->pivot->toArray();
                    unset($specialty->pivot);
                });
            }

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
                'name' => 'required|string|max:255',
                'CRM' => 'nullable|string',
                'sex' => 'nullable|string|in:Masculino,Feminino',
                'photo' => 'nullable|integer',
                'specialty' => 'nullable|array',
                'specialty.*' => 'exists:specialties,id'
            ]);

            $specialist = Specialist::findOrFail($id);

            $specialties = $request->has('specialty') ? $request->input('specialty') : [];

            $specialist->specialty()->sync($specialties);

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $specialist->id, 'specialist');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->image->id;

                    if ($specialist->photo) {
                        Image::destroy($specialist->photo);
                    }

                    $specialist->photo = $imageId;
                } else {
                    throw new \Exception('Falha ao fazer upload da imagem.');
                }
            } else {
                if ($specialist->photo) {
                    Image::destroy($specialist->photo);
                    $specialist->photo = null;
                }
            }

            if ($specialist->specialty) {
                $specialist->specialty->each(function ($specialty) {
                    $specialty->specialist_specialty = $specialty->pivot->toArray();
                    unset($specialty->pivot);
                });
            }

            $specialist->update($request->all());
            return response()->json(['message' => 'Especialista atualizado com sucesso.', 'data' => $specialist], 200);
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

            if ($specialist->photo) {
                Image::destroy($specialist->photo);
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