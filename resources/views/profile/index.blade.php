<x-layout>
    <x-slot:title>Profile Information</x-slot:title>
    <div class="max-w-xl mx-auto">
        <div>
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Profile Photo</h1>
                <p class="text-sm text-gray-500 mt-1">Update your profile picture.</p>
            </div>
            <div class="mb-6">
                <img class="size-20 rounded-full object-cover border border-gray-200" src="{{ "/storage/images/avatars/" . auth()->user()->avatar }}"  alt="profile image"/>
            </div>
            <form action="{{ route('profile.change-avatar') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-forms.field name="profile_image">
                    <x-forms.label>Profile Photo</x-forms.label>
                    <x-forms.file-upload accept="image/*" />
                    <x-forms.error-message />
                </x-forms.field>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <x-base-button type="submit">Save</x-base-button>
                </div>
            </form>
        </div>
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
                    <x-forms.input :value="old('name', auth()->user()->name)" />
                    <x-forms.error-message>
                        {{ $errors->updateProfileInformation->first('name') }}
                    </x-forms.error-message>
                </x-forms.field>
                <x-forms.field :has-error="$errors->updateProfileInformation->has('email')" name="email" required>
                    <x-forms.label>Email</x-forms.label>
                    <x-forms.input :value="old('email', auth()->user()->email)" />
                    <x-forms.error-message>
                        {{ $errors->updateProfileInformation->first('email') }}
                    </x-forms.error-message>
                </x-forms.field>
                <div class="flex items-center justify-end gap-3 pt-2">
                    <x-base-button type="submit">Save</x-base-button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
