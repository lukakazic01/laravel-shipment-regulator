@php use App\View\Components\ShipmentCard; @endphp
<div
    {{ $attributes->class(["bg-secondary/90  rounded shadow-md shadow-secondary/5 p-6"]) }}
>
    <div class="flex items-start justify-between gap-4">
        <a href="{{ route('shipments.show', $shipment->id) }}"
           class="font-semibold text-primary">{{ $shipment->title }}</a>
        <span class="shrink-0 text-xs font-semibold px-2.5 py-1 rounded capitalize bg-green-200 text-green-600">
            {{ ucfirst($shipment->status) }}
        </span>
    </div>

    <div class="mt-4 flex items-center gap-3 text-sm text-white/70">
        <span class="font-medium text-white">{{ $shipment->from_city }}, {{ $shipment->from_country }}</span>
        <i class="fa-solid fa-arrow-right text-primary"></i>
        <span class="font-medium text-white">{{ $shipment->to_city }}, {{ $shipment->to_country }}</span>
    </div>

    <p class="mt-4 text-sm text-white/70 leading-relaxed">
        {{ $shipment->details }}
    </p>

    <div class="mt-5 flex items-center justify-between">
        <span class="text-lg font-semibold text-primary">${{ number_format($shipment->price) }}</span>
        <span class="text-xs text-white/50">{{ $shipment->created_at->format('M d, Y') }}</span>
    </div>
    @if($shipment->shipmentDocuments && $shipment->shipmentDocuments->isNotEmpty())
        <div class="mt-5">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">
                Documents
            </h3>
            <div class="flex flex-wrap gap-3">
                @foreach($shipment->shipmentDocuments as $document)
                    <a
                        href="{{ url("/storage/documents$document->document_name") }}"
                        target="_blank"
                        class="group flex items-center gap-2 rounded border border-transparent bg-secondary/80 px-3 py-2 shadow-sm transition-colors hover:border-primary/50"
                    >
                        <i class="fa-solid group-hover:text-primary/50 transition-colors text-gray-700
                            {{ShipmentCard::iconBasedOnFileExtension(last(explode('.', $document->document_name)))}}"
                        >
                        </i>
                        <span class="text-sm font-medium transition-colors text-gray-700 group-hover:text-primary/50 truncate max-w-40">
                            {{ last(explode('/', $document->document_name)) }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
