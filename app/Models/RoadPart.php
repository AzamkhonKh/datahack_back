<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadPart extends Model
{
    protected $table = 'road_parts';
    protected $fillable = [
        'source',
        'source_id',
        'name_uz',
        'name_oz',
        'name_ru',
    ];
}
