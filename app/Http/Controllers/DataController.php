<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAccidents;
use App\Http\Requests\getPointRequest;
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

    public function point(getPointRequest $req)
    {
        $types = [
            'osm' => '',
            'osm_liveness_hex' => ['candidate_level'],
            'osm_liveness_region' => ['candidate_level'],
            'dtp_hex' => ['stat_total', 'stat_level'],
            'dtp_region' => ['stat_total', 'stat_level'],
            'maktab_hex' => ['maktab_total', 'maktab_level'],
            'maktab_region' => ['maktab_total', 'maktab_level'],
            'shop_hex' => ['shop_total', 'shop_level'],
            'shop_region' => ['shop_total', 'shop_level'],
        ];
        $layer = collect(explode('_', request('layer')))->last();

        $table_name = 'damas_';
        if ($layer == 'hex') 
        {
            $table_name .= $layer . '_' . request('zoom', 7);
            $way_name = '"way"';

            $q = DB::connection('pgsql_gis')
                ->table($table_name)
                ->select(
                    ...$types[request('layer')]
                );
        } else if($layer == 'region')
        {
            $table_name .= 'level_top';
            $way_name = '"pop"."way"';

            $q = DB::connection('pgsql_gis')
            ->table($table_name)
            ->select(
                ...$types[request('layer')]
            );
        }else{
            return [];
        }

        $data = $q
            ->join('planet_osm_polygon as pop', 'pop.osm_id', $table_name . '.osm_id')
            ->whereRaw(
                ' ST_CONTAINS(' . $way_name .
                ', st_transform(
                    st_flipcoordinates(
                        st_geomfromtext(\'POINT(' . request('lat') . ' ' . request('long') . ')\', 4326)), 3857))'
            )
            ->first();
        
        return $data;
    
    }

}
