<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAccidents;
use App\Models\Accident;
use App\Models\AccidentType;
use App\Models\District;
use App\Models\Region;
use App\Models\RoadCondition;
use App\Models\RoadPart;
use App\Models\RoadSurface;
use App\Models\WeatherCondition;
use DB;
use Illuminate\Http\Request;

class DataController extends Controller
{
    const PAGINATION_DATA = 10;
    /**
     * @lrd:start
     * #Hello markdown
     * ## Documentation for /my route
     * @lrd:end
     */
    public function districts()
    {
        return District::paginate(self::PAGINATION_DATA);
    }
    /**
     * @QAparam search string
     */
    public function regions()
    {
        return Region::paginate(self::PAGINATION_DATA);
    }

    public function accident_types()
    {
        return AccidentType::paginate(self::PAGINATION_DATA);
    }

    public function weather_conditions()
    {
        return WeatherCondition::paginate(self::PAGINATION_DATA);
    }

    public function road_conditions()
    {
        return RoadCondition::paginate(self::PAGINATION_DATA);
    }

    public function road_parts()
    {
        return RoadPart::paginate(self::PAGINATION_DATA);
    }

    public function road_surface()
    {
        return RoadSurface::paginate(self::PAGINATION_DATA);
    }

    public function accidents(GetAccidents $request)
    {
        return Accident::select([
                'id',
                'source',
                'source_id',
                DB::raw('ST_AsText(location) as point'),
                // DB::raw('ST_AsGeoJSON(location)::json->\'coordinates\' as point1'),
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
            ])
            ->filter()
            ->with([
                'type', 
                'region', 
                'district', 
                'road_surface', 
                'road_condition', 
                'vehicles',
                'weather_condition',
                'vehicles'
            ])
            ->paginate(request('page_size', self::PAGINATION_DATA));
    }

}
