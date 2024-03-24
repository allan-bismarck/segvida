<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function index()
    {
        try {
            $images = Image::all();
            return response()->json($images, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter as imagens.'], 500);
        }
    }


    public function upload(Request $request, ?int $owner_id, string $owner_type)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg,png|max:2048', // JPEG ou PNG, máximo de 2MB
            ], [
                'image.required' => 'O campo de imagem é obrigatório.',
                'image.image' => 'O arquivo deve ser uma imagem.',
                'image.mimes' => 'A imagem deve ser do tipo: jpeg, png.',
                'image.max' => 'O tamanho máximo da imagem é de 2MB.'
            ]);

            $image = new Image();
            $image->saveImage($request->file('image'), $owner_id, $owner_type);

            return response()->json(['message' => 'Imagem carregada com sucesso.', 'image' => $image], 201);
        } catch (\Exception $e) {
            print('Erro ao carregar imagem: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao carregar a imagem.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $image = Image::findOrFail($id);
            return response()->json($image, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Imagem não encontrada.'], 404);
        }
    }

    public function showImage($id)
    {
        try {
            $image = Image::findOrFail($id);
    
            $path = storage_path('app/public/' . $image->path);

            $contentType = mime_content_type($path);
    
            if (!file_exists($path)) {
                return response()->json(['error' => 'Imagem não encontrada.'], 404);
            }
    
            $imageData = file_get_contents($path);
    
            return response($imageData)->header('Content-Type', $contentType);;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao recuperar a imagem.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $image = Image::findOrFail($id);
            $image->delete();
            return response()->json(['message' => 'Imagem excluída com sucesso', 'id' => $id], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir a imagem.'], 500);
        }
    }
}