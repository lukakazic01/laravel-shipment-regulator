@props ([
    'name',
    'required' => false,
])
<div {{ $attributes->class(['flex flex-col gap-1']) }}>
    {{ $slot }}
</div>
