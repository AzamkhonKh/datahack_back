<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentParticipant extends Model
{
    protected $table = 'accident_participants';
    protected $fillable = [
        'source',
        'source_id',
        'vehicle_id',
        'accident_id',
        'type',
        'gender_type',
        'health_condition',
        'violation',
        'age',
    ];

    protected $casts = [
        'violation' => 'json'
    ];
}
