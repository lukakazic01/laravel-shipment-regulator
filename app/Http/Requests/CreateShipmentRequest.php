<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateShipmentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required|max:128|min:1',
            'from_city' => 'string|required|max:64|min:1',
            'from_country' => 'string|required|max:64|min:1',
            'to_city' => 'string|required|max:64|min:1',
            'to_country' => 'string|required|max:64|min:1',
            'price' => 'integer|required|min:1',
            'details' => 'string|nullable',
        ];
    }
}
