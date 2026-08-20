<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use App\Rules\UserClient;
use App\Rules\UserTrucker;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShipmentRequest extends FormRequest
{

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
            'userId' => [
                'integer',
                'required',
                new UserTrucker
            ],
            'clientId' => [
                'integer',
                'required',
                new UserClient
            ],
            'status' => [
                Rule::in(Shipment::SHIPMENT_STATUSES),
                Rule::when(
                    filled('userId'),
                    Rule::notIn(Shipment::STATUS_UNASSIGNED)
                )
            ],
        ];
    }

    public function messages(): array {
        return [
            'status.not_in' => 'Status cannot be unassigned when the user is filled',
        ];
    }
}
