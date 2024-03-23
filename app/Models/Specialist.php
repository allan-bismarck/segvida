<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'CRM',
        'genero',
        'foto'
    ];

    public function especialidade()
    {
        return $this->belongsToMany(Specialty::class, 'specialist_specialty', 'specialist_id', 'specialty_id');
    }

    public function disponibilidades()
    {
        return $this->hasMany(Availability::class);
    }

    public function agenda()
    {
        return $this->hasMany(Schedule::class);
    }
}