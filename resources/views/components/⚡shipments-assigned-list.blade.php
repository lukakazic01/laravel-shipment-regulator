<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;
    public int $addend = 1;

    public string $errorMessage = "";

    public function increment(): void  {
        $this->count+=$this->addend;
        $this->errorMessage = "";
    }

    public function decrement(): void {
        $result = $this->count - $this->addend;
        if ($result < 0) {
            $this->errorMessage = "Amount cannot be less than 0";
            return;
        }
        $this->count=$result;
    }

    public function validateAddend() {
        $this->errorMessage = $this->addend <= 0 ? "Addend cannot be less than 1" : "";
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

    <input
        wire:change="validateAddend"
        wire:model.debounce.300ms="addend"
        class="border border-gray-200 rounded p-2 {{ $errorMessage ? 'border-red-500' : '' }}"
        type="number" min="1"
    />

    <p wire:show="errorMessage" class="text-xs text-red-500">{{ $errorMessage }}</p>
</div>
