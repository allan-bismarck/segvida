<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cor',
        'icone'
    ];

    public function clinicas()
    {
        return $this->belongsToMany(Clinic::class);
    }

    public function especialistas()
    {
        return $this->belongsToMany(Specialist::class);
    }
}