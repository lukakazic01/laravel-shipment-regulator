@aware ([
    'name',
    'hasError'
])
@if ($errors->has($name) || $slot->isNotEmpty() || $hasError)
    <p {{ $attributes->class(['text-sm text-red-500']) }}>
        {{ $slot->isEmpty() ? $errors->first($name) : $slot }}
    </p>
@endif
