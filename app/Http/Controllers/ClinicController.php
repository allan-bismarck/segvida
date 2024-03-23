<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Specialty;

class ClinicController extends Controller
{
    public function index()
    {
        try {
            $clinics = Clinic::with(['especialidades', 'agenda'])->get();
            $clinics->each(function ($clinic) {
                $clinic->especialidades->each(function ($especialidade) {
                    $especialidade->clinic_specialty = $especialidade->pivot->toArray();
                    unset($especialidade->pivot);
                });
            });
            
            return response()->json($clinics);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter as clínicas.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string',
                'email' => 'required|email',
                'endereco' => 'nullable|string',
                'whatsapp' => 'nullable|string',
                'cnpj' => 'nullable|string',
                'descricao' => 'nullable|string',
                'logomarca' => 'nullable|integer',
                'especialidades' => 'nullable|array',
                'especialidades.*' => 'exists:specialties,id'
            ]);

            $clinic = Clinic::create($request->all());

            $specialties = $request->has('especialidades') ? $request->input('especialidades') : [];

            $clinic->especialidades()->sync($specialties);

            $imageId = null;

            if ($request->hasFile('imagem')) {
                $request->validate([
                    'imagem' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $clinic->id, 'clinic');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->imagem->id;
                }
            }

            if ($imageId != null) {
                $clinic->logomarca = $imageId;
            }

            if ($clinic->especialidades) {
                $clinic->especialidades->each(function ($specialty) {
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
            print($e);
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Falha ao cadastrar clínica.', 'message' => $$errorMessage], 500);
        }
    }

    public function show($id)
    {
        try {
            $clinic = Clinic::with(['especialidades', 'agenda'])->findOrFail($id);

            if ($clinic->especialidades) {
                $clinic->especialidades->each(function ($specialty) {
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
                'nome' => 'string',
                'email' => 'email',
                'endereco' => 'nullable|string',
                'whatsapp' => 'nullable|string',
                'cnpj' => 'nullable|string',
                'descricao' => 'nullable|string',
                'logomarca' => 'nullable|integer',
                'especialidades' => 'nullable|array',
                'especialidades.*' => 'exists:specialties,id'
            ]);

            $clinic = Clinic::findOrFail($id);

            $specialties = $request->has('especialidades') ? $request->input('especialidades') : [];

            $clinic->especialidades()->sync($specialties);

            if ($request->hasFile('imagem')) {

                $request->validate([
                    'imagem' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $clinic->id, 'clinic');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->imagem->id;

                    if ($clinic->logomarca) {
                        Image::destroy($clinic->logomarca);
                    }

                    $clinic->logomarca = $imageId;
                } else {
                    throw new \Exception('Falha ao fazer upload da imagem.');
                }
            } else {
                if ($clinic->logomarca) {
                    Image::destroy($clinic->logomarca);
                    $clinic->logomarca = null;
                }
            }

            if ($clinic->especialidades) {
                $clinic->especialidades->each(function ($specialty) {
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

            if ($clinic->logomarca) {
                Image::destroy($clinic->logomarca);
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