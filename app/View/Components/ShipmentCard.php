<?php

namespace App\View\Components;

use App\Models\Shipment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShipmentCard extends Component
{
    public function __construct(
        public Shipment $shipment,
    ){}

    public function render(): View|Closure|string
    {
        return view('components.shipment-card');
    }

    public static function iconBasedOnFileExtension(string $extension): string
    {
        return match ($extension) {
            'pdf' => 'fa-file-pdf',
            'doc', 'docx' => 'fa-file-word',
            default => 'fa-file-image',
        };
    }
}
