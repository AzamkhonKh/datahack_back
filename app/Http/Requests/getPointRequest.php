<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class getPointRequest extends FormRequest
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
            'lat' => ['required', 'numeric'],
            'long' => ['required', 'numeric'],
            'layer' => ['required', 'string', 'max:10'],
            'zoom' => ['required', 'numeric', 'max:15'],
        ];
    }
}
