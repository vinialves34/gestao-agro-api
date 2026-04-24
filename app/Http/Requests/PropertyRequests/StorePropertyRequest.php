<?php

namespace App\Http\Requests\PropertyRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'producer_id' => ['required', 'integer', 'exists:rural_producers,id'],
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:2'],
            'state_registration' => ['required', 'string', 'max:255'],
            'total_area' => ['required', 'string', 'max:255'],
        ];
    }
}
