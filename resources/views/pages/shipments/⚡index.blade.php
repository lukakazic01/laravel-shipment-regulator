<?php

use App\Enums\AlertSeverity;
use App\Mappers\SelectOptionsMapper;
use App\Models\Shipment;
use App\Models\User;
use App\Repositories\ShipmentRepository;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {

    /**
     * @var Collection<int, Shipment> $shipments
     */
    public Collection $shipments;

    /**
     * @var Collection<int, User> $users
     */
    public Collection $users;

    public function mount(ShipmentRepository $shipmentRepository)
    {
        $this->shipments = Shipment::query()->hydrate(
            Cache::remember('unassigned_shipments', 600, fn() => $shipmentRepository->getShipmentsByStatus(Shipment::STATUS_UNASSIGNED)->toArray())
        );
        $this->users = SelectOptionsMapper::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
    }
};
?>

<x-slot:title>All shipments</x-slot:title>
<x-base.session-message :alert-severity="AlertSeverity::Success"/>
<div class="flex flex-col gap-6">
    @forelse($shipments as $shipment)
        <x-shipment-card :shipment="$shipment" :users="$users"/>
    @empty
        <p class="text-center text-secondary text-sm">
            We currently don't have any unassigned shipment
            @can('create', Shipment::class)
                ,go ahead and
                <a href="{{ route("shipments.create") }}" class="text-blue-500">create one</a>
            @endcan
        </p>
    @endforelse
</div>
