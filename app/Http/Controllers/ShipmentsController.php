<?php

namespace App\Http\Controllers;

use App\Helpers\SelectOptions;
use App\Http\Requests\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentDocument;
use App\Models\User;
use App\Repositories\ShipmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShipmentsController extends Controller
{

    public function index(ShipmentRepository $shipmentRepository)
    {
        $shipments = Shipment::query()->hydrate(
            Cache::remember('unassigned_shipments', 600, fn () => $shipmentRepository->getShipmentsOfAuthenticatedUser()->toArray())
        );
        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        $users = SelectOptions::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
        $shipmentStatuses = SelectOptions::toSelectOptions(Shipment::SHIPMENT_STATUSES);
        return view('shipments.create', compact('users', 'shipmentStatuses'));
    }

    public function store(CreateShipmentRequest $request, ShipmentRepository $shipmentRepository)
    {
        $shipment = $shipmentRepository->createShipment($request);
        $docMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        foreach($request->file('documents') as $document) {
            if (str_starts_with($document->getMimeType(), 'image/')) {
                $name = $this->uploadImage($document, "/documents/$shipment->id/");
                $name = '/' . $shipment->id . '/' . $name;
                ShipmentDocument::query()->create([
                    'shipment_id' => $shipment->id,
                    'document_name' => $name,
                ]);
            } else if (in_array($document->getMimeType(), $docMimes)) {
                $extension = $document->extension();
                $name= uniqid() . "." . $extension;
                $path = $document->storeAs("documents/$shipment->id", $name, "public");
                $path = str_replace("documents/", "/", $path);
                ShipmentDocument::query()->create([
                    'shipment_id' => $shipment->id,
                    'document_name' => $path,
                ]);
            }
        }
        Cache::forget('unassigned_shipments');
        return redirect()->route('shipments.index');
    }

    public function show(Shipment $shipment)
    {
        $shipment->load('shipmentDocuments');
        return view('shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        //
    }

    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    public function destroy(Shipment $shipment)
    {
        //
    }
}
