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
}
