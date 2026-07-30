<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use App\Models\User;
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
            'from_city' => 'string|required|max:64|min:1',
            'from_country' => 'string|required|max:64|min:1',
            'to_city' => 'string|required|max:64|min:1',
            'to_country' => 'string|required|max:64|min:1',
            'price' => 'integer|required|min:1',
            'details' => 'string|nullable',
            'user_id' => [
                'integer',
                'required',
                new UserTrucker
            ],
            'status' => [
                Rule::in(Shipment::SHIPMENT_STATUSES),
                Rule::when(
                    $this->filled('user_id'),
                    Rule::notIn(Shipment::STATUS_UNASSIGNED)
                )
            ],
        ];
    }

    public function messages(): array {
        return [
            'status.not_in' => 'Status cannot be unassigned when the user is filled',
            'user_id.exists' => 'You must assign to a user that is a trucker'
        ];
    }
}
