<?php

use App\Traits\HandleImagesTrait;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

new class extends Component {
    use HandleImagesTrait;
    use WithFileUploads;

    #[Validate('required|image|mimes:jpeg,png,jpg,webp,avif|max:4096')]
    public TemporaryUploadedFile|null $profileImage = null;

    public function submit()
    {
        dd('hellow');
//        $this->deleteImageFromStorage(auth()->user()->avatar ?? '', "images/avatars/");
//        $name = $this->uploadImage($request->file('profile_image'), "images/avatars/");
//        auth()->user()->update(['avatar' => $name]);
    }

    public function updatedProfileImage()
    {
        $this->validate();
    }
};
?>

<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Profile Photo</h1>
        <p class="text-sm text-gray-500 mt-1">Update your profile picture.</p>
    </div>
    <div class="mb-6" wire:show="{{ (bool) auth()->user()->avatar }}">
        <img class="size-20 rounded-full object-cover border border-gray-200"
             src="{{ "/storage/images/avatars/" . auth()->user()->avatar }}" alt="profile image"/>
    </div>
    <form wire:submit="submit" method="POST" class="space-y-6" enctype="multipart/form-data">
        <x-forms.field name="profileImage">
            <x-forms.label>Profile Photo</x-forms.label>
            <x-forms.file-upload wire:model.live="profileImage" accept="image/*"/>
            <x-forms.error-message/>
        </x-forms.field>
        <div class="flex items-center justify-end gap-3 pt-2">
            <x-base-button type="submit">Save</x-base-button>
        </div>
    </form>
</div>
