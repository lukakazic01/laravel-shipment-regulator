<?php

use App\Mappers\SelectOptionsMapper;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public Shipment $shipment;

    /**
     * @var Collection<int, Shipment> $shipmentStatuses
     */
    public Collection $shipmentStatuses;

    /**
     * @var Collection<int, User> $users
     */
    public Collection $users;

    public string $title = "";
    public string $fromCity = "";
    public string $fromCountry = "";
    public string $toCity = "";
    public string $toCountry = "";
    public string $status = "";
    public string $userId = "";
    public string $clientId = "";
    public int $price;
    public string $details = "";
    public array $documents = [];

    public function mount(): void
    {
        $this->shipmentStatuses = SelectOptionsMapper::toSelectOptions(Shipment::SHIPMENT_STATUSES);
        $this->users = SelectOptionsMapper::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
    }

    public function submit()
    {
        dd($this->status);
    }
};
?>

<x-slot:title>Edit shipment</x-slot:title>
<form wire:submit="submit" enctype="multipart/form-data"
      class="flex flex-col gap-4">
    @csrf
    <x-forms.field required name="title">
        <x-forms.label>Title</x-forms.label>
        <x-forms.input wire:model.live="title"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="from_city">
        <x-forms.label>From city</x-forms.label>
        <x-forms.input wire:model="fromCity"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="from_country">
        <x-forms.label>From country</x-forms.label>
        <x-forms.input wire:model="fromCountry"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="to_city">
        <x-forms.label>To city</x-forms.label>
        <x-forms.input wire:model="toCity"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="to_country">
        <x-forms.label>To country</x-forms.label>
        <x-forms.input wire:model="toCountry"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="status">
        <x-forms.label>Status</x-forms.label>
        <x-forms.select wire:model="status" :values="$shipmentStatuses" :selected="$shipment->status"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="user_id">
        <x-forms.label>Trucker</x-forms.label>
        <x-forms.select wire:model="userId" :values="$users" :selected="$shipment->user_id"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="client_id">
        <x-forms.label>Client</x-forms.label>
        <x-forms.select wire:model="clientId" :values="$users" :selected="$shipment->client_id"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field required name="price">
        <x-forms.label>Price</x-forms.label>
        <x-forms.input wire:model="price" type="number" :value="old('price', $shipment->price)"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="details">
        <x-forms.label>Details</x-forms.label>
        <x-forms.textarea wire:model="details" :value="old('details', $shipment->details)"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="documents[]">
        <x-forms.label>Documents</x-forms.label>
        <x-forms.file-upload wire:model="documents" multiple/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-base-button type="submit">Edit shipment</x-base-button>
</form>
