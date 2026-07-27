<button
    {{ $attributes->merge(['type' => 'button'])->class([
        'flex items-center justify-center rounded px-4 py-2.5 text-sm font-semibold text-white
        bg-primary hover:bg-primary/90 transition-colors duration-150 outline-none cursor-pointer',
    ]) }}
>
    {{ $slot }}
</button>
