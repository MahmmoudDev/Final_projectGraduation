<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class lawyer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'password',
        'specialization_id',
        'experience',
        'image',
        'status',
    ];
    protected
        $hidden = [

            'password',

        ];

    use Notifiable;

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
        return $this->hasMany(
            availabilitie::class,
            'service_provider_id'
        );
    }

    public function consultations()
    {
        return $this->hasMany(
            consultations::class,
            'service_provider_id'
        );
    }
}
