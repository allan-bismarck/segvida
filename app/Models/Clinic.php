<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'endereco',
        'whatsapp',
        'cnpj',
        'email',
        'descricao',
        'logomarca'
    ];

    protected $casts = [
        'horario_funcionamento' => 'array'
    ];

    public function especialidades()
    {
        return $this->belongsToMany(Specialty::class, 'clinic_specialty', 'clinic_id', 'specialty_id');
    }

    public function agenda()
    {
        return $this->hasMany(Schedule::class);
    }

    public function disponibilidades()
    {
        return $this->hasMany(Availability::class);
    }
}