<?php

namespace App\Http\Requests\HerdRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHerdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => ['integer', 'exists:properties,id'],
            'species_id' => ['integer', 'exists:species,id'],
            'quantity' => ['integer', 'min:1'],
            'purpose' => ['string', 'max:255'],
        ];
    }
}
