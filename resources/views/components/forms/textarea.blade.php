@aware([
    'name',
    'required',
])

<textarea
    name="{{ $name }}"
    id="{{ $name }}"
    @if ($required) required @endif
    {{
        $attributes
        ->class([
            'w-full bg-white resize-none border border-gray-200 text-secondary rounded px-4 py-2 outline-none transition-all
             duration-150 focus:shadow-md focus:shadow-primary/15 focus:ring-2 focus:ring-primary',
            'border-red-500' => $errors->has($name),
        ])
        ->merge([
            'rows' => '4'
        ])
    }}
>{{ $value ?? '' }}</textarea>
