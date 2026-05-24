<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'service_provider_id',
        'service_type',
        'appointment_date',
        'appointment_time',
        'status',
        'notes'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(doctor::class, 'service_provider_id');
    }

    public function lawyer()
    {
        return $this->belongsTo(lawyer::class, 'service_provider_id');
    }
    public function consultation()
    {
        return $this->hasOne(
            consultations::class
        );
    }
}
