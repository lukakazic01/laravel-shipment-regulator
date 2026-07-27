<x-layout>
    <x-slot:title>All shipments</x-slot:title>
    <div class="flex flex-col gap-6">
        @foreach($shipments as $shipment)
            <x-shipment-card :shipment="$shipment" />
        @endforeach
    </div>
</x-layout>
