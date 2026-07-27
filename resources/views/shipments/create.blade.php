<x-layout>
    <x-slot:title>Create shipment</x-slot:title>
    <form method="POST" action="{{ route('shipments.store') }}" class="flex flex-col gap-4">
        @csrf
        <x-forms.field required name="title">
            <x-forms.label>Title</x-forms.label>
            <x-forms.input :value="old('title', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-forms.field required name="from_city">
            <x-forms.label>From city</x-forms.label>
            <x-forms.input :value="old('from_city', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-forms.field required name="from_country">
            <x-forms.label>From country</x-forms.label>
            <x-forms.input :value="old('from_country', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-forms.field required name="to_city">
            <x-forms.label>To city</x-forms.label>
            <x-forms.input :value="old('to_city', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-forms.field required name="to_country">
            <x-forms.label>To country</x-forms.label>
            <x-forms.input :value="old('to_country', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-forms.field required name="price">
            <x-forms.label>Price</x-forms.label>
            <x-forms.input type="number" :value="old('price', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-forms.field name="details">
            <x-forms.label>Details</x-forms.label>
            <x-forms.textarea :value="old('details', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-base-button type="submit">Create shipment</x-base-button>
    </form>
</x-layout>
