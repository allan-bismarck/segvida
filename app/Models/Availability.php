<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'horario_chegada',
        'horario_saida',
        'dia',
        'clinic_id',
        'specialist_id'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }
}