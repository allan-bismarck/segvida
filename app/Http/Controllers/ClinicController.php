<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\Image;

class ClinicController extends Controller
{
    public function index()
    {
        try {
            $clinics = Clinic::with(['specialties', 'schedules', 'availabilities'])->get();
            
            $clinics->each(function ($clinic) {
                $clinic->specialties->each(function ($specialty) {
                    $specialty->clinic_specialty = $specialty->pivot->toArray();
                    unset($specialty->pivot);
                });
            });
            
            return response()->json($clinics);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao obter as clínicas.', 'message' => $errorMessage], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'address' => 'nullable|string',
                'whatsapp' => 'nullable|string',
                'cnpj' => 'nullable|string',
                'description' => 'nullable|string',
                'photo' => 'nullable|integer',
                'specialties' => 'nullable|array',
                'specialties.*' => 'exists:specialties,id'
            ]);

            $clinic = Clinic::create($request->all());

            $specialties = $request->has('specialties') ? $request->input('specialties') : [];

            $clinic->specialties()->sync($specialties);

            $imageId = null;

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $clinic->id, 'clinic');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->image->id;
                }
            }

            if ($imageId != null) {
                $clinic->photo = $imageId;
            }

            if ($clinic->specialties) {
                $clinic->specialties->each(function ($specialty) {
                    $specialty->clinic_specialty = $specialty->pivot->toArray();
                    unset($specialty->pivot);
                });
            }

            $clinic->save();

            return response()->json(['message' => 'Clínica cadastrada com sucesso.', 'data' => $clinic], 201);
         } catch (ValidationException $e) {
            $errorMessage = $e->errors();
            $errorTitle = reset($errorMessage);
            return response()->json(['error' => 'Falha ao cadastrar clínica.', 'message' => $errorTitle], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Falha ao cadastrar clínica.', 'message' => $$errorMessage], 500);
        }
    }

    public function show($id)
    {
        try {
            $clinic = Clinic::with(['specialties', 'schedules', 'availabilities'])->findOrFail($id);

            if ($clinic->specialties) {
                $clinic->specialties->each(function ($specialty) {
                    $specialty->clinic_specialty = $specialty->pivot->toArray();
                    unset($specialty->pivot);
                });
            }

            return response()->json($clinic);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Clínica não encontrada.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter a clínica.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'address' => 'nullable|string',
                'whatsapp' => 'nullable|string',
                'cnpj' => 'nullable|string',
                'description' => 'nullable|string',
                'photo' => 'nullable|integer',
                'specialties' => 'nullable|array',
                'specialties.*' => 'exists:specialties,id'
            ]);

            $clinic = Clinic::findOrFail($id);

            $specialties = $request->has('specialties') ? $request->input('specialties') : [];

            $clinic->specialties()->sync($specialties);

            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $clinic->id, 'clinic');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->image->id;

                    if ($clinic->photo) {
                        Image::destroy($clinic->photo);
                    }

                    $clinic->photo = $imageId;
                } else {
                    throw new \Exception('Falha ao fazer upload da imagem.');
                }
            } else {
                if ($clinic->photo) {
                    Image::destroy($clinic->photo);
                    $clinic->photo = null;
                }
            }

            if ($clinic->specialties) {
                $clinic->specialties->each(function ($specialty) {
                    $specialty->clinic_specialty = $specialty->pivot->toArray();
                    unset($specialty->pivot);
                });
            }

            $clinic->update($request->all());

            return response()->json(['message' => 'Clínica atualizada com sucesso.', 'data' => $clinic], 200);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Falha ao atualizar clínica.', 'message' => $errorMessage], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $clinic = Clinic::findOrFail($id);

            if ($clinic->photo) {
                Image::destroy($clinic->photo);
            }

            $clinic->delete();
            return response()->json(['message' => 'Clínica deletada com sucesso', 'id' => $id], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Clínica não encontrada.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar a clínica.'], 500);
        }
    }
}