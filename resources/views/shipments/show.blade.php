@php
    use App\View\Components\ShipmentCard;
@endphp

<x-layout>
    <div class="bg-white rounded-xl border border-gray-200">

        <div class="p-6 border-b border-gray-100">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-medium text-secondary/50 uppercase tracking-wide">Shipment</p>
                    <h3 class="mt-1 text-xl font-semibold text-primary">{{ $shipment->title }}</h3>
                </div>
                <span class="text-xs font-semibold px-3 py-1 rounded-full capitalize ring-1 ring-inset bg-green-200 text-green-500">
                {{ implode(' ', explode('_', ucfirst($shipment->status))) }}
            </span>
            </div>
        </div>

        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <p class="text-xs text-secondary/50 mb-1">From</p>
                    <p class="font-medium text-secondary">{{ $shipment->from_city }}, {{ $shipment->from_country }}</p>
                </div>
                <i class="fa-solid fa-truck text-primary"></i>
                <div class="flex-1 text-right">
                    <p class="text-xs text-secondary/50 mb-1">To</p>
                    <p class="font-medium text-secondary">{{ $shipment->to_city }}, {{ $shipment->to_country }}</p>
                </div>
            </div>
        </div>

        <div class="px-6 py-5 border-b border-gray-100">
            <p class="text-sm text-secondary/70 leading-relaxed">{{ $shipment->details }}</p>

            <div class="mt-4 flex items-center justify-between">
                <span class="text-2xl font-semibold text-primary">${{ $shipment->price }}</span>
                <span class="text-xs text-secondary/50">Created {{ $shipment->created_at->format('M d, Y') }}</span>
            </div>
        </div>

        @if($shipment->shipmentDocuments && $shipment->shipmentDocuments->isNotEmpty())
            <div class="px-6 py-5 {{ $shipment->can_edit ?? true ? 'border-b border-gray-100' : '' }}">
                <h3 class="text-xs font-semibold text-secondary/50 uppercase tracking-wide mb-3">Documents</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($shipment->shipmentDocuments as $document)
                        <a
                        href="{{ url("/storage/documents$document->document_name") }}"
                        target="_blank"
                        class="group flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 transition-colors hover:border-primary/40 hover:bg-white"
                        >
                        <i class="fa-solid text-gray-500 group-hover:text-primary transition-colors
                            {{ ShipmentCard::iconBasedOnFileExtension(last(explode('.', $document->document_name))) }}"
                        ></i>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-primary transition-colors truncate max-w-[10rem]">
                            {{ last(explode('/', $document->document_name)) }}
                        </span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @can('view-edit-shipment-page', $shipment)
            <div class="px-6 py-4 flex justify-end">
                <a
                    href="{{ route('shipments.edit', $shipment->id) }}"
                    class="text-sm font-semibold text-white bg-primary px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors"
                >
                    Edit shipment
                </a>
            </div>
        @endcan
    </div>
</x-layout>
