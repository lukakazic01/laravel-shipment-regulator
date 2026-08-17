<?php

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Collection $shipmentStatuses;
    public Collection $users;
    public string $title;
    public string $fromCity;
    public string $fromCountry;
    public string $toCity;
    public string $toCountry;
    public string $status;
    public int $client;
    public int $price;
    public string $details;
    public array $documents = [];

    public string $clientError;

    public function validateUser()
    {
        $user = User::query()->find($this->client);
        $this->clientError = !$user ? "User doesnt exist" : "";
    }
};
?>

<form method="POST" action="{{ route('shipments.store') }}" enctype="multipart/form-data" class="flex flex-col gap-4">
    @csrf
    <x-forms.field required name="title">
        <x-forms.label>Title</x-forms.label>
        <x-forms.input wire:model.live.debounce="title" :value="old('title', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="from_city">
        <x-forms.label>From city</x-forms.label>
        <x-forms.input wire:model.live.debounce="fromCity" :value="old('from_city', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="from_country">
        <x-forms.label>From country</x-forms.label>
        <x-forms.input wire:model.live.debounce="fromCountry" :value="old('from_country', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="to_city">
        <x-forms.label>To city</x-forms.label>
        <x-forms.input wire:model.live.debounce="toCity" :value="old('to_city', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="to_country">
        <x-forms.label>To country</x-forms.label>
        <x-forms.input wire:model.live.debounce="toCountry" :value="old('to_country', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="status">
        <x-forms.label>Status</x-forms.label>
        <x-forms.select wire:model.live.debounce="status" :values="$shipmentStatuses"
                        :selected="Shipment::STATUS_UNASSIGNED"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="client_id">
        <x-forms.label>Client</x-forms.label>
        <x-forms.select wire:blur="validateUser" wire:model.live.debounce="client" :values="$users"/>
        <p wire:show="clientError" class="text-red-500 text-sm">{{ $clientError }}</p>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="price">
        <x-forms.label>Price</x-forms.label>
        <x-forms.input wire:model.live.debounce="price" type="number" :value="old('price', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="details">
        <x-forms.label>Details</x-forms.label>
        <x-forms.textarea wire:model.live.debounce="details" :value="old('details', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="documents[]">
        <x-forms.label>Documents</x-forms.label>
        <x-forms.file-upload wire:model.live.debounce="documents" multiple/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-base-button type="submit">Create shipment</x-base-button>
</form>

