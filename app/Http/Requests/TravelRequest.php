<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60',
            'description' => 'required',
            'city_id' => 'required',
            'file' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'places' => 'required',
            'price' => 'required',
            'last_minute' => 'required|string|max:1',
            'all_inclusive' => 'required|string|max:1',
        ];
    }
}
