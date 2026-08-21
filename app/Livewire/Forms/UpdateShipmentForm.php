<?php

namespace App\Livewire\Forms;

use App\Models\Shipment;
use App\Rules\UserClient;
use App\Rules\UserTrucker;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UpdateShipmentForm extends Form
{
    public string $title = "";
    public string $fromCity = "";
    public string $fromCountry = "";
    public string $toCity = "";
    public string $toCountry = "";
    public string $status = "";
    public string|null $userId = "";
    public string|null $clientId = "";
    public int $price;
    public string $details = "";
    public array $documents = [];

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
