<?php

use App\Actions\Fortify\UpdateUserProfileInformation;
use Livewire\Component;

new class extends Component {
    public string $name = "";
    public string $email = "";

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function updateProfileInformation(UpdateUserProfileInformation $updateProfileInformation)
    {
        $updateProfileInformation->update(
            auth()->user(),
            [
                'name' => $this->name,
                'email' => $this->email
            ]
        );
        $this->dispatch('success', message: 'Successfully updated user profile information');
    }

    public function resetToOldValues() {
        $this->email = auth()->user()->email;
        $this->name = auth()->user()->name;
        $this->resetErrorBag();
    }

};
?>

<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Profile Information</h1>
        <p class="text-sm text-gray-500 mt-1">Update your account's profile information and email address.</p>
    </div>
    <form wire:submit="updateProfileInformation" action="{{ route('user-profile-information.update') }}" method="POST"
          class="space-y-6">
        @csrf
        @method('PUT')
        <x-forms.field :has-error="$errors->updateProfileInformation->has('name')" name="name" required>
            <x-forms.label>Name</x-forms.label>
            <x-forms.input wire:model.debounce.300ms="name"/>
            <x-forms.error-message>
                {{ $errors->updateProfileInformation->first('name') }}
            </x-forms.error-message>
        </x-forms.field>
        <x-forms.field :has-error="$errors->updateProfileInformation->has('email')" name="email" required>
            <x-forms.label>Email</x-forms.label>
            <x-forms.input wire:model.debounce.300ms="email"/>
            <x-forms.error-message>
                {{ $errors->updateProfileInformation->first('email') }}
            </x-forms.error-message>
        </x-forms.field>
        <div class="flex items-center justify-between gap-3 pt-2">
            <x-base-button wire:click="resetToOldValues" class="bg-secondary!">Reset</x-base-button>
            <x-base-button loader-target="updateProfileInformation" type="submit">Save</x-base-button>
        </div>
    </form>
</div>
