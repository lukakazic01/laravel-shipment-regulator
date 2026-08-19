<?php

namespace App\View\Components\Base;

use App\Enums\AlertSeverity;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SessionMessage extends Component
{

    public function __construct(
        public ?string $sessionKey,
        public AlertSeverity $alertSeverity,
    ){}

    public static function applyClassBasedOnSeverity(AlertSeverity $severity): string
    {
        return match ($severity) {
            AlertSeverity::Success => 'bg-green-100 text-green-500 border-green-500',
            AlertSeverity::Error => 'bg-red-100 text-red-500 border-red-500',
            AlertSeverity::Info => 'bg-blue-100 text-blue-500 border-blue-500',
            AlertSeverity::Warning => 'bg-yellow-100 text-yellow-500 border-yellow-500',
        };
    }

    public function render(): View|Closure|string
    {
        return view('components.base.session-message');
    }
}
