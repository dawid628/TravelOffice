<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\UserRole;

class ChangeRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, UserRole::TYPES)) {
                        $fail('Niepoprawna rola użytkownika.');
                    }
                },
            ],
        ];
    }
}
