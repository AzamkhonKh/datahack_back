<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadCondition extends Model
{
    protected $table = 'road_conditions';
    protected $fillable = [
        'source',
        'source_id',
        'name_uz',
        'name_oz',
        'name_ru',
    ];
}
