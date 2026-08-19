<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<x-slot:title>Profile Information</x-slot:title>
<div class="max-w-xl mx-auto">
    <livewire:profile.update-profile-photo />
    <livewire:profile.update-profile-information />
</div>
