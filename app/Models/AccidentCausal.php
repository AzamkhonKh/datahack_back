<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentCausal extends Model
{
    protected $table = 'accident_causals';
    protected $fillable = [
        'source',
        'source_id',
        'name_uz',
        'name_oz',
        'name_ru',
        'accident_id',
    ];
}
