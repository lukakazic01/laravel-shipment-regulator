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
            Cache::remember('unassigned_shipments', 3600, fn () => $shipmentRepository->getShipmentsByStatus(Shipment::STATUS_UNASSIGNED)->toArray())
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
