<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'motivo_consulta',
        'hora_inicio',
        'hora_fim',
        'pagamento',
        'clinica',
        'especialista',
        'paciente',
    ];

    protected $casts = [
        'hora_inicio' => 'datetime',
        'hora_fim' => 'datetime',
    ];

    public function clinica()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function especialista()
    {
        return $this->belongsTo(Specialist::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Patient::class);
    }
}