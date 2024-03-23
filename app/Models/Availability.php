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
    ];

    public function clinica()
    {
        return $this->belongsTo(Clinic::class, 'clinica');
    }

    public function especialista()
    {
        return $this->belongsTo(Specialist::class, 'especialista');
    }
}