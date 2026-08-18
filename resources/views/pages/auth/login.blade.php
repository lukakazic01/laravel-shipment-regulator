<x-layout>
    <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
        @csrf
        <x-forms.field required name="email">
            <x-forms.label>Email</x-forms.label>
            <x-forms.input type="email" :value="old('email', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-forms.field required name="password">
            <x-forms.label>Password</x-forms.label>
            <x-forms.input type="password" :value="old('password', '')" />
            <x-forms.error-message />
        </x-forms.field>
        <x-base-button type="submit">Submit</x-base-button>
    </form>
</x-layout>
