<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class specialization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
    ];

    public function doctors()
    {
        return $this->hasMany(doctor::class);
    }

    public function lawyers()
    {
        return $this->hasMany(lawyer::class);
    }
}
