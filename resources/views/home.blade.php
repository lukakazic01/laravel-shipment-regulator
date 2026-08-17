<x-layout>
    <x-slot:title>Home</x-slot:title>
    <p class="text-center text-sm">
        Welcome to our shipment manager, to see all the shipments,
        <a href="{{ route('shipments.index') }}" class="text-blue-500">go here</a>
    </p>
</x-layout>
