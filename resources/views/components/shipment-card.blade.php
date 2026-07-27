<div class="bg-secondary/90  rounded shadow-md shadow-secondary/5 p-6">
    <div class="flex items-start justify-between gap-4">
        <h3 class="font-semibold text-primary">{{ $shipment->title }}</h3>
        <span class="shrink-0 text-xs font-semibold px-2.5 py-1 rounded capitalize bg-green-200 text-green-600">
            {{ $shipment->status }}
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
</div>
