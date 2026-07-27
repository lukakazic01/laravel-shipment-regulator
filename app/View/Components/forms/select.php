<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class select extends Component
{

    /**
     * @param Collection<int, array{label: string|int, value: string|int}> $values
     * @param string|int|null $selected
     */
    public function __construct(
        public Collection $values,
        public int|string|null $selected = null,
    ){}

    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
