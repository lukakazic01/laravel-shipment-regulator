@aware([
    'name', 'required'
])

<label {{ $attributes->class(['text-sm']) }} for="{{ $name }}">
    {{ $slot }}
    @if ($required)
        <span class="text-red-500">*</span>
    @endif
</label>
