<?php

use App\Mappers\SelectOptionsMapper;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {

    public Collection $users;
    public Collection $shipmentStatuses;

    public function mount()
    {
        $this->users = SelectOptionsMapper::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
        $this->shipmentStatuses = SelectOptionsMapper::toSelectOptions(Shipment::SHIPMENT_STATUSES);
    }
};
?>

<x-slot:title>Create shipment</x-slot:title>
<div>
    <livewire:create-shipment :shipment-statuses="$shipmentStatuses" :users="$users"/>
</div>
