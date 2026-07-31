<?php

namespace App\Observers;

use App\Models\Shipment;
use Illuminate\Support\Facades\Cache;

class ShipmentObserver
{
    public function creating(Shipment $shipment): void {
        if ($shipment::STATUS_UNASSIGNED === $shipment->status) {
            Cache::forget('unassigned_shipments');
        }
    }

    public function updating(Shipment $shipment): void {
        if($shipment::STATUS_IN_PROGRESS === $shipment->status) {
            Cache::forget('unassigned_shipments');
        }
    }

    public function deleting(): void {
        Cache::forget('unassigned_shipments');
    }
}
