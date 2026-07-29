<?php

namespace App\Http\Controllers;

use App\Helpers\SelectOptions;
use App\Http\Requests\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\User;
use App\Repositories\ShipmentRepository;
use App\Services\ShipmentDocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShipmentsController extends Controller
{

    public function index(ShipmentRepository $shipmentRepository)
    {
        $shipments = Shipment::query()->hydrate(
            Cache::remember('in_progress_shipments', 600, fn () => $shipmentRepository->getShipmentsByStatus(Shipment::STATUS_IN_PROGRESS)->toArray())
        );
        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        $users = SelectOptions::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
        $shipmentStatuses = SelectOptions::toSelectOptions(Shipment::SHIPMENT_STATUSES);
        return view('shipments.create', compact('users', 'shipmentStatuses'));
    }

    public function store(
        CreateShipmentRequest $request,
        ShipmentRepository $shipmentRepository,
        ShipmentDocumentService $shipmentDocumentService
    )
    {
        $shipment = $shipmentRepository->createShipment($request);
        $shipmentDocumentService->storeShipmentDocuments($shipment, $request->file('documents'));
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
