<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'name',
        'email',
        'mobile',
        'password',
        'status'
    ];
    protected $hidden = [

        'password'
    ];
    use Notifiable;

    public function home() {}
}
