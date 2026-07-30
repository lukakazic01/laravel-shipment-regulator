@php use App\Models\Shipment; @endphp
<x-layout>
    <x-slot:title>Edit shipment</x-slot:title>
    <form method="POST" action="{{ route('shipments.update', $shipment->id) }}" enctype="multipart/form-data" class="flex flex-col gap-4">
        @csrf
        @method('PATCH')
        <x-forms.field required name="title">
            <x-forms.label>Title</x-forms.label>
            <x-forms.input :value="old('title', $shipment->title)"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field required name="from_city">
            <x-forms.label>From city</x-forms.label>
            <x-forms.input :value="old('from_city', $shipment->from_city)"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field required name="from_country">
            <x-forms.label>From country</x-forms.label>
            <x-forms.input :value="old('from_country', $shipment->from_country)"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field required name="to_city">
            <x-forms.label>To city</x-forms.label>
            <x-forms.input :value="old('to_city', $shipment->to_city)"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field required name="to_country">
            <x-forms.label>To country</x-forms.label>
            <x-forms.input :value="old('to_country', $shipment->to_country)"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field required name="status">
            <x-forms.label>To country</x-forms.label>
            <x-forms.select :values="$shipmentStatuses" :selected="$shipment->status"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field required name="user_id">
            <x-forms.label>Trucker</x-forms.label>
            <x-forms.select :values="$users" :selected="$shipment->user_id"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field required name="client_id">
            <x-forms.label>Client</x-forms.label>
            <x-forms.select :values="$users" :selected="$shipment->client_id" />
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field required name="price">
            <x-forms.label>Price</x-forms.label>
            <x-forms.input type="number" :value="old('price', $shipment->price)"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field name="details">
            <x-forms.label>Details</x-forms.label>
            <x-forms.textarea :value="old('details', $shipment->details)"/>
            <x-forms.error-message/>
        </x-forms.field>
        <x-forms.field name="documents[]">
            <x-forms.label>Documents</x-forms.label>
            <x-forms.file-upload multiple />
            <x-forms.error-message/>
        </x-forms.field>
        <x-base-button type="submit">Edit shipment</x-base-button>
    </form>
</x-layout>
