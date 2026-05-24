<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class doctor extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'address',
        'specialization_id',
        'experience',
        'image',
        'status',
    ];
    protected
        $hidden = [

            'password',

        ];

    public function specialization()
    {
        return $this->belongsTo(specialization::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class,  'service_provider_id');
    }

    public function availabilities()
    {
        return $this->hasMany(availabilitie::class, 'service_provider_id')->where('service_type', 'doctor');
    }
    public function consultations()
    {
        return $this->hasMany(
            consultations::class,
            'service_provider_id'
        );
    }
}
