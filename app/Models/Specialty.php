<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'photo'
    ];

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class);
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class);
    }
}