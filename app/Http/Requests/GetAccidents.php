<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetAccidents extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'accident_id' => ['integer'],
            'type_id' => ['integer'],
            'region_id' => ['integer'],
            'district_id' => ['integer'],
            'road_part_id' => ['integer'],
            'road_surface_id' => ['integer'],
            'road_condition_id' => ['integer'],
            'weather_condition_id' => ['integer'],

            'card_number' => ['string'],
            'date_accident_from' => ['date:Y-m-d'],
            'date_accident_to' => ['date:Y-m-d'],

            'page' => ['integer'],
            'page_size' => ['integer', 'max:20'],
        ];
    }
}
