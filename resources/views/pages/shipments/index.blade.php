<x-layout>
    <x-slot:title>All shipments</x-slot:title>
    <div class="flex flex-col gap-6">
        @forelse($shipments as $shipment)
            <x-shipment-card :shipment="$shipment" :users="$users" />
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
</x-layout>
