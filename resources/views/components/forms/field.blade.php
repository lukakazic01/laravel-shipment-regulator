@props ([
    'name',
    'required' => false,
])
<div {{ $attributes->merge() }}>
    {{ $slot }}
</div>
