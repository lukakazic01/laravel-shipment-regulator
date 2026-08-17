<?php

use App\Http\Requests\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\User;
use App\Repositories\ShipmentRepository;
use App\Services\ShipmentDocumentService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
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

    #[Validate('required|integer|exists:users,id')]
    public int $clientId;

    public int $price;
    public string $details;
    public array $documents = [];

    public function validateUser(): void
    {
        $this->validateOnly('clientId');
    }

    public function submit(ShipmentRepository $shipmentRepository, ShipmentDocumentService $shipmentDocumentService): void
    {
        $request = new CreateShipmentRequest();
        $data = $this->validate($request->rules());
        $shipment = $shipmentRepository->createShipment($data);
        $shipmentDocumentService->storeShipmentDocuments($shipment, $this->documents);
    }
};
?>

<form wire:submit="submit" enctype="multipart/form-data" class="flex flex-col gap-4">
    @csrf
    <x-forms.field name="title">
        <x-forms.label>Title</x-forms.label>
        <x-forms.input wire:model.live.debounce="title" :value="old('title', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="fromCity">
        <x-forms.label>From city</x-forms.label>
        <x-forms.input wire:model.live.debounce="fromCity" :value="old('fromCity', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="fromCountry">
        <x-forms.label>From country</x-forms.label>
        <x-forms.input wire:model.live.debounce="fromCountry" :value="old('fromCountry', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="toCity">
        <x-forms.label>To city</x-forms.label>
        <x-forms.input wire:model.live.debounce="toCity" :value="old('toCity', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="toCountry">
        <x-forms.label>To country</x-forms.label>
        <x-forms.input wire:model.live.debounce="toCountry" :value="old('toCountry', '')"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="status">
        <x-forms.label>Status</x-forms.label>
        <x-forms.select wire:model.live.debounce="status" :values="$shipmentStatuses"
                        :selected="Shipment::STATUS_UNASSIGNED"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="clientId">
        <x-forms.label>Client</x-forms.label>
        <x-forms.select wire:blur="validateUser" wire:model.live.debounce="clientId" :values="$users"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="price">
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

