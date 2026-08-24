<?php

use App\Livewire\Forms\CreateShipmentForm;
use App\Models\Shipment;
use App\Models\User;
use App\Repositories\ShipmentRepository;
use App\Services\ShipmentDocumentService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Authorize;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public CreateShipmentForm $form;
    public Collection $shipmentStatuses;
    public Collection $users;

    #[Authorize('create', Shipment::class)]
    public function submit(ShipmentRepository $shipmentRepository, ShipmentDocumentService $shipmentDocumentService): void
    {
        $data = $this->form->validate();
        $snakeCasedValidatedData = collect($data)->mapWithKeys(fn($value, $key) => [Str::snake($key) => $value])->toArray();
        $shipment = $shipmentRepository->createShipment($snakeCasedValidatedData);
        $shipmentDocumentService->storeShipmentDocuments($shipment, $this->form->documents);
        redirect()->route('shipments.index')->with(['message' => 'You successfully created new unassigned shipment']);
    }
};
?>

<form wire:submit="submit" class="flex flex-col gap-4">
    <x-forms.field name="form.title">
        <x-forms.label>Title</x-forms.label>
        <x-forms.input wire:model.live.blur="form.title"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.fromCity">
        <x-forms.label>From city</x-forms.label>
        <x-forms.input wire:model.live.blur="form.fromCity"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.fromCountry">
        <x-forms.label>From country</x-forms.label>
        <x-forms.input wire:model.live.blur="form.fromCountry"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.toCity">
        <x-forms.label>To city</x-forms.label>
        <x-forms.input wire:model.live.blur="form.toCity"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.toCountry">
        <x-forms.label>To country</x-forms.label>
        <x-forms.input wire:model.live.blur="form.toCountry"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.status">
        <x-forms.label>Status</x-forms.label>
        <x-forms.select wire:model.live.blur="form.status" :values="$shipmentStatuses"
                        :selected="Shipment::STATUS_UNASSIGNED"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.clientId">
        <x-forms.label>Client</x-forms.label>
        <x-forms.select wire:model.live.blur="form.clientId" :values="$users"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.price">
        <x-forms.label>Price</x-forms.label>
        <x-forms.input wire:model.live.blur="form.price" type="number"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.details">
        <x-forms.label>Details</x-forms.label>
        <x-forms.textarea wire:model.live.blur="form.details"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.documents">
        <x-forms.label>Documents</x-forms.label>
        <x-forms.file-upload wire:model.live.blur="form.documents" multiple/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-base-button type="submit">Create shipment</x-base-button>
</form>

