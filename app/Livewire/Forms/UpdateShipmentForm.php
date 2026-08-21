<?php

namespace App\Livewire\Forms;

use App\Models\Shipment;
use App\Rules\UserClient;
use App\Rules\UserTrucker;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateShipmentForm extends Form
{
    #[Validate]
    public string $title = "";

    #[Validate]
    public string $fromCity = "";

    #[Validate]
    public string $fromCountry = "";

    #[Validate]
    public string $toCity = "";

    #[Validate]
    public string $toCountry = "";

    #[Validate]
    public string $status = "";

    #[Validate]
    public string|null $userId = "";

    #[Validate]
    public string|null $clientId = "";

    #[Validate]
    public int $price;

    #[Validate]
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
