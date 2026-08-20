<?php

use App\Http\Requests\UpdateShipmentRequest;
use App\Mappers\SelectOptionsMapper;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Authorize;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
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
    public string|null $userId = "";
    public string|null $clientId = "";
    public int $price;
    public string $details = "";
    public array $documents = [];

    public function mount(): void
    {
        $this->shipmentStatuses = SelectOptionsMapper::toSelectOptions(Shipment::SHIPMENT_STATUSES)->add(['label' => 'o', 'value' => 'ok']);
        $this->users = SelectOptionsMapper::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');

        $this->title = $this->shipment->title;
        $this->fromCity = $this->shipment->from_city;
        $this->fromCountry = $this->shipment->from_country;
        $this->toCity = $this->shipment->to_city;
        $this->toCountry = $this->shipment->to_country;
        $this->status = $this->shipment->status;
        $this->userId = $this->shipment->user_id;
        $this->clientId = $this->shipment->client_id;
        $this->price = $this->shipment->price;
        $this->details = $this->shipment->details;
    }

    #[Authorize('update', Shipment::class)]
    public function submit(): void
    {
        $request = new UpdateShipmentRequest();
        $validatedData = $this->validate($request->rules());
        $snakeCased = collect($validatedData)->mapWithKeys(fn($value, $key) => [Str::snake($key) => $value])->toArray();
        $shipment->update($snakeCased);
        redirect()->route('shipments.index');
    }
};
?>

<x-slot:title>Edit shipment</x-slot:title>
<form wire:submit="submit" class="flex flex-col gap-4">
    @csrf
    <x-forms.field name="title">
        <x-forms.label>Title</x-forms.label>
        <x-forms.input wire:model.blur="title"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="fromCity">
        <x-forms.label>From city</x-forms.label>
        <x-forms.input wire:model.blur="fromCity"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="fromCountry">
        <x-forms.label>From country</x-forms.label>
        <x-forms.input wire:model.blur="fromCountry"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="toCity">
        <x-forms.label>To city</x-forms.label>
        <x-forms.input wire:model.blur="toCity"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="toCountry">
        <x-forms.label>To country</x-forms.label>
        <x-forms.input wire:model.blur="toCountry"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="status">
        <x-forms.label>Status</x-forms.label>
        <x-forms.select wire:model.blur="status" :values="$shipmentStatuses" />
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="userId">
        <x-forms.label>Trucker</x-forms.label>
        <x-forms.select wire:model.blur="userId" :values="$users" />
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="clientId">
        <x-forms.label>Client</x-forms.label>
        <x-forms.select wire:model.blur="clientId" :values="$users" />
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="price">
        <x-forms.label>Price</x-forms.label>
        <x-forms.input wire:model.blur="price" type="number" />
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="details">
        <x-forms.label>Details</x-forms.label>
        <x-forms.textarea wire:model.blur="details" :value="old('details', $shipment->details)"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="documents[]">
        <x-forms.label>Documents</x-forms.label>
        <x-forms.file-upload wire:model.blur="documents" multiple/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-base-button loader-target="updateShipment" type="submit">Edit shipment</x-base-button>
</form>
