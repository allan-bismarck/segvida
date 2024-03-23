<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nome',
        'data_nascimento',
        'genero',
        'endereco',
        'whatsapp',
        'email',
        'rg',
        'cpf',
        'user_name',
        'foto'
    ];

    public function agenda()
    {
        return $this->hasMany(Schedule::class);
    }
}