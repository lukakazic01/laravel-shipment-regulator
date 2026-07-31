@php
    use App\View\Components\ShipmentCard;
@endphp

<div
    {{ $attributes->class(["bg-white rounded border border-gray-200 p-6"]) }}
>
    <div class="flex items-start justify-between gap-4">
        <h3 class="font-semibold text-primary">{{ $shipment->title }}</h3>
        <span class="shrink-0 text-xs font-semibold px-2.5 py-1 rounded capitalize bg-green-200 text-green-600">
            {{ implode(' ', explode('_', ucfirst($shipment->status))) }}
        </span>
    </div>

    <div class="mt-4 flex items-center gap-3 text-sm text-secondary/70">
        <span class="font-medium text-secondary">{{ $shipment->from_city }}, {{ $shipment->from_country }}</span>
        <i class="fa-solid fa-arrow-right text-primary"></i>
        <span class="font-medium text-secondary">{{ $shipment->to_city }}, {{ $shipment->to_country }}</span>
    </div>

    <p class="mt-4 text-sm text-secondary/70 leading-relaxed">
        {{ $shipment->details }}
    </p>

    <div class="mt-5 flex items-center justify-between">
        <span class="text-lg font-semibold text-primary">${{ number_format($shipment->price) }}</span>
        <span class="text-xs text-secondary/50">{{ $shipment->created_at->format('M d, Y') }}</span>
    </div>
    <div class="mt-5">
        <h3 class="text-xs font-semibold text-secondary/50 uppercase tracking-wide mb-3">Assign Trucker</h3>
        <form method="POST">
            @csrf
            @method('PATCH')
            <x-forms.field required name="trucker_id">
                <x-forms.label>Trucker</x-forms.label>
                <x-forms.select :values="$users" />
                <x-forms.error-message/>
            </x-forms.field>
            <div class="mt-3">
                <x-base-button type="submit" class="w-40 max-w-40">
                    Save
                </x-base-button>
            </div>
        </form>
    </div>
    @canany(['view-edit-shipment-page', 'view'], $shipment)
        <div class="mt-5 flex items-center gap-6 justify-end">
            @can('view-edit-shipment-page', $shipment)
                <a href="{{ route('shipments.edit', $shipment->id) }}" class="text-sm font-semibold text-primary">Edit</a>
            @endcan
            @can('view', $shipment)
                <a href="{{ route('shipments.show', $shipment->id) }}" class="text-sm font-semibold text-primary">Show</a>
            @endcan
        </div>
    @endcanany
</div>
