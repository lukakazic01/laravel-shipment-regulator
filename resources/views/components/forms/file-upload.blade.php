@aware(['required', 'name'])

<input
    name="{{ $name }}"
    id="{{ $name }}"
    type="file"
    {{ $required ? 'required' : '' }}
    {{ $attributes
        ->class([
            'w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-gray-900
             focus:outline-none focus:ring-2 focus:primary focus:primary cursor-pointer',
            'file:mr-4 file:py-1.5 file:px-3.5 file:rounded-md file:border-0 file:text-sm file:font-semibold
             file:bg-primary/90 file:text-white hover:file:primary/80 file:transition-colors file:cursor-pointer',
            'border-red-400 focus:ring-red-400 focus:border-red-400' => $errors->has($name),
        ])
    }}
/>
