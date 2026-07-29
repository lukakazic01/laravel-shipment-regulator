<?php

namespace App\Services;

use App\Models\Shipment;
use App\Repositories\ShipmentDocumentRepository;
use App\Traits\HandleImages;
use Illuminate\Http\UploadedFile;

class ShipmentDocumentService
{
    use HandleImages;

    const array ALLOWED_DOCUMENT_MIME_TYPES = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];

    public function __construct(
        public ShipmentDocumentRepository $shipmentDocumentRepository,
    ){}

    /**
     * @param Shipment $shipment
     * @param UploadedFile[] $documents
     * @return void
     */
    public function storeShipmentDocuments(Shipment $shipment, array $documents): void
    {
        foreach ($documents as $document) {
            if (str_starts_with($document->getMimeType(), 'image/')) {
                $this->storeImage($document, $shipment->id);
            } else if (in_array($document->getMimeType(), self::ALLOWED_DOCUMENT_MIME_TYPES)) {
                $this->storeDocument($document, $shipment->id);
            }
        }
    }

    private function storeImage(UploadedFile $document, int $shipmentId): void {
        $name = $this->uploadImage($document, "/documents/$shipmentId/");
        $name = '/' . $shipmentId . '/' . $name;
        $this->shipmentDocumentRepository->createShipmentDocument($shipmentId, $name);
    }

    private function storeDocument(UploadedFile $document, int $shipmentId): void {
        $extension = $document->extension();
        $name = uniqid() . "." . $extension;
        $path = $document->storeAs("documents/$shipmentId", $name, "public");
        $path = str_replace("documents/", "/", $path);
        $this->shipmentDocumentRepository->createShipmentDocument($shipmentId, $path);
    }

}
