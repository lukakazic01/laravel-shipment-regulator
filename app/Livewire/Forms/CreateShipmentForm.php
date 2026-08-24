<?php

namespace App\Livewire\Forms;

use App\Models\Shipment;
use App\Rules\UserClient;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateShipmentForm extends Form
{
    #[Validate]
    public string $title;

    #[Validate]
    public string $fromCity;

    #[Validate]
    public string $fromCountry;

    #[Validate]
    public string $toCity;

    #[Validate]
    public string $toCountry;

    #[Validate]
    public string $status;

    #[Validate]
    public int $clientId;

    #[Validate]
    public int $price;

    #[Validate]
    public string $details;

    #[Validate]
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
            'status' => Rule::in(Shipment::SHIPMENT_STATUSES),
            'clientId' => [
                'required',
                'integer',
                'exists:users,id',
                new UserClient,
            ],
            'documents' => 'required|array',
            'documents.*' => 'file|mimes:jpeg,png,jpg,webp,docx,pdf,doc|max:10240',
        ];
    }
}
