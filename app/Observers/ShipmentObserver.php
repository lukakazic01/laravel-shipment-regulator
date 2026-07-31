<?php

namespace App\Observers;

use App\Models\Shipment;
use Illuminate\Support\Facades\Cache;

class ShipmentObserver
{
    public function created(Shipment $shipment): void {
        if ($shipment::STATUS_UNASSIGNED === $shipment->status) {
            Cache::forget('unassigned_shipments');
        }
    }

    public function updated(): void {
        Cache::forget('unassigned_shipments');
    }

    public function deleted(): void {
        Cache::forget('unassigned_shipments');
    }
}
