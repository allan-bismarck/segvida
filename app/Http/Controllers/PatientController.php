<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Models\Image;

class PatientController extends Controller
{
    public function index()
    {
        try {
            $patients = Patient::with('schedules')->get();
            return response()->json($patients);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter os pacientes.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $patient = Patient::with('schedules')->findOrFail($id);
            return response()->json($patient);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Paciente não encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter o paciente.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'date_of_birth' => 'nullable|date',
                'sex' => 'nullable|string|in:Masculino,Feminino',
                'address' => 'nullable|string|max:255',
                'whatsapp' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'rg' => 'nullable|string|max:255',
                'cpf' => 'nullable|string|max:255',
                'user_name' => 'required|string|max:255',
                'photo' => 'nullable|integer',
            ]);

            $patient = Patient::create($request->all());

            $imageId = null;

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $patient->id, 'patient');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->image->id;
                }
            }

            if ($imageId != null) {
                $patient->photo = $imageId;
            }

            $patient->save();

            return response()->json(['message' => 'Paciente cadastrado com sucesso.', 'data' => $patient], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao criar o paciente.', 'message' => $errorMessage], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'date_of_birth' => 'nullable|date',
                'sex' => 'nullable|string|in:Masculino,Feminino',
                'address' => 'nullable|string|max:255',
                'whatsapp' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'rg' => 'nullable|string|max:255',
                'cpf' => 'nullable|string|max:255',
                'user_name' => 'required|string|max:255',
                'photo' => 'nullable|integer',
            ]);

            $patient = Patient::findOrFail($id);

            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validação para a imagem
                ]);

                $imageController = new ImageController();

                $response = $imageController->upload($request, $patient->id, 'patient');

                if ($response->getStatusCode() == 201) {
                    $imageId = $response->getData()->image->id;

                    if ($patient->photo) {
                        Image::destroy($patient->photo);
                    }

                    $patient->photo = $imageId;
                } else {
                    throw new \Exception('Falha ao fazer upload da imagem.');
                }
            } else {
                if ($patient->photo) {
                    Image::destroy($patient->photo);
                    $patient->photo = null;
                }
            }

            $patient->update($request->all());

            return response()->json(['message' => 'Paciente atualizado com sucesso.', 'data' => $patient], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Paciente não encontrado.'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            $errorMessage = explode("\n", $e->getMessage())[0];
            return response()->json(['error' => 'Erro ao atualizar o paciente.', 'message' => $errorMessage], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $patient = Patient::findOrFail($id);

            if ($patient->photo) {
                Image::destroy($patient->photo);
            }

            $patient->delete();
            return response()->json(['message' => 'Paciente deletado com sucesso. Id: ' . $id], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Paciente não encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar o paciente.'], 500);
        }
    }
}