<?php

namespace App\Jobs;

use App\Service\DTPService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Enums\Sources;
use App\Models\Accident;
use App\Models\AccidentCausal;
use App\Models\AccidentParticipant;
use App\Models\AccidentType;
use App\Models\AccidentVehicle;
use App\Models\District;
use App\Models\Region;
use App\Models\RoadCondition;
use App\Models\RoadPart;
use App\Models\RoadSurface;
use App\Models\WeatherCondition;
use Illuminate\Support\Carbon;
use Log;

class GetDTPAccident implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($min_page, $max_page)
    {
        $this->min_page = $min_page;
        $this->max_page = $max_page;
        $this->sources = Sources::DTP;
    }

    public Sources $sources;
    public int $min_page;
    public int $max_page;
    public $timeout = 240;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new DTPService();
        while($this->min_page < $this->max_page)
        {
            try
            {
                $data = $service->paginate($this->min_page);
                $accidents = $data->map(fn(array $ac) => $this->create_accident($ac));
            }catch(\Exception $e){
                Log::error($e);
                echo "dispatching new job with min page: $this->min_page \n";
                dispatch(new self($this->min_page, $this->min_page + 1));
            }
            $this->min_page++;
        }
    }

    public function create_accident(array $accident): Accident
    {
        $check = Accident::where('source_id', $accident['id'])->first();
        if(!empty($check))
        {
            echo "accident not proccessed ". $accident['id'] . "\n";
            $accident_causal = $this->findOrFail($accident, 'accident_causal', AccidentCausal::class, $check);
            return $check;
        }
        $orginal_data = $accident;
        $accident_type = $this->findOrFail($accident, 'accident_type', AccidentType::class);
        $region = $this->findOrFail($accident, 'region', Region::class);
        $district = $this->findOrFail($accident, 'district', District::class);
        $road_surface = $this->findOrFail($accident, 'road_surface', RoadSurface::class);
        $road_condition = $this->findOrFail($accident, 'road_condition', RoadCondition::class);
        $weather_condition = $this->findOrFail($accident, 'weather_condition', WeatherCondition::class);
        $road_part = $this->findOrFail($accident, 'road_part', RoadPart::class);
        $accident_model = [
            'location' => !empty($accident['location']) ? 'point('.str_replace(',',' ',$accident['location']).')' : null,
            'type_id' => $accident_type->id ?? null,
            'region_id' => $region->id ?? null,
            'district_id' => $district->id ?? null,
            'road_surface_id' => $road_surface->id ?? null,
            'road_condition_id' => $road_condition->id ?? null,
            'weather_condition_id' => $weather_condition->id ?? null,
            'road_part_id' => $road_part->id ?? null,
            'street_name' => $accident['street_name'],
            'distance_from' => $accident['distance_from'],
            'accident_number' => $accident['accident_number'],
            'card_number' => $accident['card_number'],
            'date_accident' => !empty($accident['date_accident']) ? Carbon::createFromFormat('Y-m-d\TH:i:s',$accident['date_accident'], 'Asia/Tashkent')->format('Y-m-d H:i:s') : null,
            'accident_json' => json_encode($orginal_data)
        ];
        $result = Accident::updateOrCreate(['source_id' => $accident['id']], $this->set_source($accident_model));
        $vehicles = $this->findOrFail($accident, 'vehicles', AccidentVehicle::class, $result);
        $participants = $this->findOrFail($accident, 'participants', AccidentParticipant::class, $result);

        return $result;
    }

    public function findOrFail(array &$accident, string $key, string $model, ?Accident $accident_model = null): ?object
    {
        $result = null;
        if(array_key_exists($key, $accident) && !empty($accident[$key])){
            if(array_key_exists('id', $accident[$key]))
            {
                $accident[$key] = [$accident[$key]];
            }
            foreach($accident[$key] as $val)
            {
                if(!is_null($accident_model))
                {
                    $val['accident_id'] = $accident_model['id'];
                }
                $data = (array)$this->set_source($val);
                unset($data['source_id']);
                $result = $model::updateOrCreate(['source_id' => $val['id']],$data);
            }
        }
        unset($accident[$key]);
        return $result;
    }

    public function set_source(array $data): array
    {
        $result = (array) $data;
        if(array_key_exists('id', $result)){
            $result['source_id'] = $result['id'];
            unset($result['id']);
        }
        $key = 'vehicle';
        if(array_key_exists($key, $result) && is_numeric($result[$key]))
        {
            $result['vehicle_id'] = AccidentVehicle::select('id')
                ->where('source', $this->sources->value)
                ->where('source_id', $result[$key])
                ->firstOrFail()->id;
            unset($result[$key]);
        }
        $result['source'] = $this->sources->value;
        return $result;
    }
}
