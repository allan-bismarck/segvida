<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'owner_id',
        'owner_type'
    ];

    protected $uploadsDirectory = 'images';

    public function saveImage($image, $owner_id, $owner_type)
    {

        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/' . $this->uploadsDirectory, $imageName);
        $this->name = $imageName;
        $this->path = $this->uploadsDirectory . '/' . $imageName;
        $this->owner_id = $owner_id;
        $this->owner_type = $owner_type;
        $this->save();
    }

    public function getUrl()
    {
        return Storage::url($this->path);
    }
}
