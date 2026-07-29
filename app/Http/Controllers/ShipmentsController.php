<?php

namespace App\Http\Controllers;

use App\Helpers\SelectOptions;
use App\Http\Requests\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\User;
use App\Repositories\ShipmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use JetBrains\PhpStorm\NoReturn;

class ShipmentsController extends Controller
{

    public function index(ShipmentRepository $shipmentRepository)
    {
        $shipments = Shipment::query()->hydrate(
            Cache::remember('unassigned_shipments', 600, fn () => $shipmentRepository->getShipmentsByStatus(Shipment::STATUS_UNASSIGNED)->toArray())
        );
        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        $users = SelectOptions::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
        $shipmentStatuses = SelectOptions::toSelectOptions(Shipment::SHIPMENT_STATUSES);
        return view('shipments.create', compact('users', 'shipmentStatuses'));
    }

    #[NoReturn]
    public function store(CreateShipmentRequest $request, ShipmentRepository $shipmentRepository)
    {
        $docMimes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        foreach($request->file('documents') as $document) {
            if (str_starts_with($document->getMimeType(), 'image/')) {
                dd('image');
            } else if (in_array($document->getMimeType(), $docMimes)) {
                dd('document');
            }
        }
        $shipmentRepository->createShipment($request);
        Cache::forget('unassigned_shipments');
        return redirect()->route('shipments.index');
    }

    public function show(Shipment $shipment)
    {
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
