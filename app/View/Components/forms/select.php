<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class select extends Component
{

    /**
     * @param array{label: string|int, value: string|int} $values
     * @param string $name
     * @param bool $required
     */
    public function __construct(
        public array $values,
        public string $name,
        public bool $required = false,
        public int|string|null $selected = null,
    ){}

    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
