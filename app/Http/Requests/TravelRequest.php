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
            'city_id' => 'required|string',
            'file' => 'required|file',
            'date_from' => 'required|string',
            'date_to' => 'required|string',
            'places' => 'required|string',
            'price' => 'required|string',
            'last_minute' => 'required|string|max:1',
            'all_inclusive' => 'required|string|max:1',
        ];
    }
}
