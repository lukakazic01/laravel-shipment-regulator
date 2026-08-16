<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;
    public int $addend = 1;

    public function increment() {
        $this->count+=$this->addend;
    }

    public function decrement() {
        if ($this->count - $this->addend >= 0) {
            $this->count-=$this->addend;
        }
    }

};
?>

<div class="flex flex-col gap-2">
    <button class="bg-blue-300 text-white p-1" type="button" wire:click="increment">
        Increment {{$count}}
    </button>


    <button class="bg-red-300 text-white p-1" type="button" wire:click="decrement">
        Decrement {{$count}}
    </button>

    <input class="border border-gray-200 rounded p-2" type="number" min="1" wire:model.debounce="addend" />
</div>
