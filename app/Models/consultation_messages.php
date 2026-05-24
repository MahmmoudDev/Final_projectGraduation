<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultation_messages extends Model
{
    use HasFactory;
    protected $fillable = [

        'consultation_id',
        'sender_id',
        'sender_type',
        'message'
    ];

    public function consultation()
    {
        return $this->belongsTo(
            consultations::class
        );
    }
}
