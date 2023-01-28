<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentType extends Model
{
    protected $table = 'accident_types';
    protected $fillable = [
        'source',
        'source_id',
        'name_uz',
        'name_oz',
        'name_ru',
    ];
}
