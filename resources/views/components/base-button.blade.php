@props([
    "loaderTarget" => ""
])

<button
    {{ $attributes->merge(['type' => 'button'])->class([
        'flex items-center justify-center relative rounded px-4 py-2.5 text-sm font-semibold text-white
        bg-primary hover:bg-primary/90 transition-colors duration-150 outline-none cursor-pointer',
    ]) }}
>
    <span
        @if ($loaderTarget)
            wire:loading.class="opacity-0"
            wire:target="{{ $loaderTarget }}"
        @endif
    >
        {{ $slot }}
    </span>

    @if ($loaderTarget)
        <span
            wire:loading
            wire:target="{{ $loaderTarget }}"
            class="absolute z-200 size-5 rounded-full border-2 border-white-300 border-t-transparent animate-spin"
        />
    @endif
</button>
