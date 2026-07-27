<div class="bg-white rounded shadow-md shadow-secondary/5 p-6">
    <div class="flex items-start justify-between gap-4">
        <h3 class="font-semibold text-secondary">{{ $shipment->title }}</h3>
        <span class="shrink-0 text-xs font-semibold px-2.5 py-1 rounded capitalize bg-green-200 text-green-600">
            {{ $shipment->status }}
        </span>
    </div>

    <div class="mt-4 flex items-center gap-3 text-sm text-secondary/70">
        <span class="font-medium text-secondary">{{ $shipment->from_city }}, {{ $shipment->from_country }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary shrink-0">
            <path d="M5 12h14" />
            <path d="m12 5 7 7-7 7" />
        </svg>
        <span class="font-medium text-secondary">{{ $shipment->to_city }}, {{ $shipment->to_country }}</span>
    </div>

    <p class="mt-4 text-sm text-secondary/70 leading-relaxed">
        {{ $shipment->details }}
    </p>

    <div class="mt-5 flex items-center justify-between">
        <span class="text-lg font-semibold text-primary">${{ number_format($shipment->price) }}</span>
        <span class="text-xs text-secondary/50">{{ $shipment->created_at->format('M d, Y') }}</span>
    </div>
</div>
