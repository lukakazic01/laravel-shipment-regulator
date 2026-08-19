<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    //

    public string $message = "";

    #[On('success')]
    public function handleSuccessMessage(string $message)
    {
        $this->message = $message;
    }
};
?>

<x-slot:title>Profile Information</x-slot:title>
<div class="max-w-xl mx-auto">
    @if($message)
        <div
            class=" bg-green-100 flex text-sm justify-center mb-6 border text-green-500 border-green-500 p-2 rounded w-full">
            {{ $message }}
        </div>
    @endif
    <livewire:profile.update-profile-photo/>
    <livewire:profile.update-profile-information/>
</div>
