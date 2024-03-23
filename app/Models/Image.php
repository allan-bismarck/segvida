<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'caminho',
        'owner_id',
        'owner_type'
    ];

    protected $uploadsDirectory = 'imagens';

    public function saveImage($imagem, $owner_id, $owner_type)
    {

        print($owner_id);

        $imagemName = time() . '_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
        $imagem->storeAs('public/' . $this->uploadsDirectory, $imagemName);
        $this->nome = $imagemName;
        $this->caminho = $this->uploadsDirectory . '/' . $imagemName;
        $this->owner_id = $owner_id;
        $this->owner_type = $owner_type;
        $this->save();
    }

    public function getUrl()
    {
        return Storage::url($this->caminho);
    }
}
