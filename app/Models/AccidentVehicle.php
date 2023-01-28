<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccidentVehicle extends Model
{
    protected $table = 'accident_vehicles';
    protected $fillable = [
        'source',
        'source_id',
        'technical_issues',
        'vehicle_brand',
        'vehicle_model',
        'vehicle_type',
        'vehicle_color',
        'year_manufacture',
        'accident_id',
    ];
    protected $casts = [
        'technical_issues' => 'json',
        'vehicle_brand' => 'json',
        'vehicle_model' => 'json',
        'vehicle_type' => 'json',
        'vehicle_color' => 'json',
    ];
}
