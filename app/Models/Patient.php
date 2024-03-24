<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'sex',
        'address',
        'whatsapp',
        'email',
        'rg',
        'cpf',
        'user_name',
        'photo'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}