@aware ([
    'name'
])

@if ($errors->has($name))
    <p {{ $attributes->class(['text-sm text-red-500']) }}>
        {{ $errors->first($name) }}
    </p>
@endif
