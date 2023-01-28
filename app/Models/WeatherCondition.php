<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherCondition extends Model
{
    protected $table = 'weather_conditions';
    protected $fillable = [
        'source',
        'source_id',
        'name_uz',
        'name_oz',
        'name_ru',
    ];
}
