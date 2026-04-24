<?php

namespace App\Http\Requests\PropertyRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'producer_id' => ['integer', 'exists:rural_producers,id'],
            'name' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'state' => ['string', 'max:255'],
            'state_registration' => ['string', 'max:255'],
            'total_area' => ['string', 'min:1'],
        ];
    }
}
