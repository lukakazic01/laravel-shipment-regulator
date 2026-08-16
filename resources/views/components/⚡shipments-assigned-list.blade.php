<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;
    public int $addend = 1;

    public bool $isLessThanZero;

    public function updatedIsLessThanZero() {
        dd('hi');
    }

    public function increment(): void  {
        $this->count+=$this->addend;
        $this->isLessThanZero = false;
    }

    public function decrement(): void {
        $result = $this->count - $this->addend;
        if ($result < 0) {
            $this->isLessThanZero = true;
            return;
        }
        $this->count=$result;
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

    <input class="border border-gray-200 rounded p-2" type="number" min="1" wire:model.live="addend" />

    <p wire:show="isLessThanZero" class="text-xs text-red-500">The result after decrement cannot be less than 0</p>
</div>
