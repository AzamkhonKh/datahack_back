<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    protected $table = 'accidents';
    public $fillable = [
        'source',
        'source_id',
        'location',
        'type_id',
        'region_id',
        'district_id',
        'road_part_id',
        'road_surface_id',
        'road_condition_id',
        'weather_condition_id',
        'street_name',
        'distance_from',
        'accident_number',
        'card_number',
        'date_accident',
        'accident_json'
    ];

    protected $hidden = [
        'accident_json',
        'type_id',
        'region_id',
        'district_id',
        'road_part_id',
        'road_surface_id',
        'road_condition_id',
        'weather_condition_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'accident_json`' => 'json',
    ];

    public function scopeFilter(Builder $q): void
    {
        $filter_keys = [
            'type_id',
            'region_id',
            'district_id',
            'road_part_id',
            'road_surface_id',
            'road_condition_id',
            'weather_condition_id',
            'card_number'
        ];

        foreach($filter_keys as $key)
        {
            if(!empty(request($key))){
                $q->where($key, request($key));
            }
        }

        $key = 'accident_id';
        if(!empty(request($key)))
        {
            $q->where('id', request($key));
        }
        
        $key = 'date_accident_from';
        if(!empty(request($key)))
        {
            $q->whereDate('date_accident' , '>=', request($key));
        }

        $key = 'date_accident_to';
        if(!empty(request($key)))
        {
            $q->whereDate('date_accident', '<=', request($key));
        }
    }

    public function type()
    {
        return $this->belongsTo(AccidentType::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function road_part()
    {
        return $this->belongsTo(RoadPart::class);
    }

    public function road_surface()
    {
        return $this->belongsTo(RoadPart::class);
    }

    public function road_condition()
    {
        return $this->belongsTo(RoadCondition::class);
    }

    public function weather_condition()
    {
        return $this->belongsTo(WeatherCondition::class);
    }

    public function vehicles()
    {
        return $this->hasMany(AccidentVehicle::class);
    }
}
