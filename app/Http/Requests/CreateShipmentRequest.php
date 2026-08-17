<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use App\Rules\UserClient;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'fromCity' => 'string|required|max:64|min:1',
            'fromCountry' => 'string|required|max:64|min:1',
            'toCity' => 'string|required|max:64|min:1',
            'toCountry' => 'string|required|max:64|min:1',
            'price' => 'integer|required|min:1',
            'details' => 'string|nullable',
            'status' => Rule::in(Shipment::SHIPMENT_STATUSES),
            'clientId' => [
                'required',
                'integer',
                new UserClient,
            ],
            'documents' => 'required|array',
            'documents.*' => 'file|mimes:jpeg,png,jpg,webp,docx,pdf,doc|max:10240',
        ];
    }
}
