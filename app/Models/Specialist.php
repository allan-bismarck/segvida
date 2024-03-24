<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'CRM',
        'sex',
        'photo'
    ];

    public function specialty()
    {
        return $this->belongsToMany(Specialty::class, 'specialist_specialty', 'specialist_id', 'specialty_id');
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}