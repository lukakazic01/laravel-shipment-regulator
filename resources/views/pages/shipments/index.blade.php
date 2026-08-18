<x-layout>
    <x-slot:title>All shipments</x-slot:title>
    @if(session()->has('message'))
        <div class=" bg-green-100 flex text-sm justify-center mb-6 border text-green-500 border-green-500 p-2 rounded w-full">
            {{ session()->get('message') }}
        </div>
    @endif
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
