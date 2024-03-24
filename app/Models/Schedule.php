<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'reason_for_consultation',
        'start_time',
        'end_time',
        'payment',
        'clinic_id',
        'specialist_id',
        'patient_id'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}