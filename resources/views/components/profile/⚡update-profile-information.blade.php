<?php

use Livewire\Component;

new class extends Component
{
    public string $name = "";
    public string $email = "";

    public function mount() {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }
};
?>

<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Profile Information</h1>
        <p class="text-sm text-gray-500 mt-1">Update your account's profile information and email address.</p>
    </div>
    <form action="{{ route('user-profile-information.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <x-forms.field :has-error="$errors->updateProfileInformation->has('name')" name="name" required>
            <x-forms.label>Name</x-forms.label>
            <x-forms.input wire:model.debounce.300ms="name" />
            <x-forms.error-message>
                {{ $errors->updateProfileInformation->first('name') }}
            </x-forms.error-message>
        </x-forms.field>
        <x-forms.field :has-error="$errors->updateProfileInformation->has('email')" name="email" required>
            <x-forms.label>Email</x-forms.label>
            <x-forms.input wire:model.debounce.300ms="email" />
            <x-forms.error-message>
                {{ $errors->updateProfileInformation->first('email') }}
            </x-forms.error-message>
        </x-forms.field>
        <div class="flex items-center justify-end gap-3 pt-2">
            <x-base-button type="submit">Save</x-base-button>
        </div>
    </form>
</div>
