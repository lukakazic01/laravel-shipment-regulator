@props ([
    'name',
    'required' => false,
    'hasError' => false,
])
<div {{ $attributes->class(['flex flex-col gap-1']) }}>
    {{ $slot }}
</div>
