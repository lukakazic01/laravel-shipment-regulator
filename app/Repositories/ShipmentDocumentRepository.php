<?php

namespace App\Repositories;

use App\Models\ShipmentDocument;

class ShipmentDocumentRepository
{
    public function __construct(
        public ShipmentDocument $shipmentDocument,
    ){}

    public function createShipmentDocument(string $shipmentId, string $documentName): ShipmentDocument {
        return ShipmentDocument::query()->create([
            'shipment_id' => $shipmentId,
            'document_name' => $documentName,
        ]);
    }

}
