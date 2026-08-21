<?php

use App\Http\Requests\UpdateShipmentRequest;
use App\Livewire\Forms\UpdateShipmentForm;
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
    public UpdateShipmentForm $form;


    public function mount(): void
    {
        $this->shipmentStatuses = SelectOptionsMapper::toSelectOptions(Shipment::SHIPMENT_STATUSES)->add(['label' => 'o', 'value' => 'ok']);
        $this->users = SelectOptionsMapper::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
        $this->form->fill(collect($this->shipment->getOriginal())->mapWithKeys(fn ($value, $key) => [Str::camel($key) => $value]));
    }

    #[Authorize('update', Shipment::class)]
    public function submit(): void
    {
        $validatedData = $this->form->validate();
        $snakeCased = collect($validatedData)->mapWithKeys(fn($value, $key) => [Str::snake($key) => $value])->toArray();
        $this->shipment->update($snakeCased);
        redirect()->route('shipments.index')->with('message', "Successfully edited {$this->shipment->title} shipment");
    }
};
?>

<x-slot:title>Edit shipment</x-slot:title>
<form wire:submit="submit" class="flex flex-col gap-4">
    @csrf
    <x-forms.field name="form.title">
        <x-forms.label>Title</x-forms.label>
        <x-forms.input wire:model.blur="form.title"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.fromCity">
        <x-forms.label>From city</x-forms.label>
        <x-forms.input wire:model.blur="form.fromCity"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.fromCountry">
        <x-forms.label>From country</x-forms.label>
        <x-forms.input wire:model.blur="form.fromCountry"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.toCity">
        <x-forms.label>To city</x-forms.label>
        <x-forms.input wire:model.blur="form.toCity"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.toCountry">
        <x-forms.label>To country</x-forms.label>
        <x-forms.input wire:model.blur="form.toCountry"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.status">
        <x-forms.label>Status</x-forms.label>
        <x-forms.select wire:model.blur="form.status" :values="$shipmentStatuses"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.userId">
        <x-forms.label>Trucker</x-forms.label>
        <x-forms.select wire:model.blur="form.userId" :values="$users"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.clientId">
        <x-forms.label>Client</x-forms.label>
        <x-forms.select wire:model.blur="form.clientId" :values="$users"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.price">
        <x-forms.label>Price</x-forms.label>
        <x-forms.input wire:model.blur="form.price" type="number"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.details">
        <x-forms.label>Details</x-forms.label>
        <x-forms.textarea wire:model.blur="form.details" :value="old('details', $shipment->details)"/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-forms.field name="form.documents[]">
        <x-forms.label>Documents</x-forms.label>
        <x-forms.file-upload wire:model.blur="form.documents" multiple/>
        <x-forms.error-message/>
    </x-forms.field>
    <x-base-button loader-target="submit" type="submit">Edit shipment</x-base-button>
</form>
