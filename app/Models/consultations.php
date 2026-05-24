<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class consultations extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'appointment_id',
        'user_id',
        'service_provider_id',
        'service_type',
        'title',
        'question',
        'answer',
        'status'
    ];
    public function appointment()
    {
        return $this->belongsTo(
            Appointment::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }
    public function messages()
    {
        return $this->hasMany(
            consultation_messages::class
        );
    }
    public function doctor()
    {
        return $this->belongsTo(
            doctor::class,
            'service_provider_id'
        );
    }
    public function lawyer()
    {
        return $this->belongsTo(
            lawyer::class,
            'service_provider_id'
        );
    }
}
