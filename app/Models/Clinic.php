<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'whatsapp',
        'cnpj',
        'email',
        'description',
        'photo'
    ];

    protected $casts = [
        'opening_hours' => 'array'
    ];

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'clinic_specialty', 'clinic_id', 'specialty_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }
}