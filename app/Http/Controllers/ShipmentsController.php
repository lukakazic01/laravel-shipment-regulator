<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Mappers\SelectOptionsMapper;
use App\Models\Shipment;
use App\Models\User;
use App\Repositories\ShipmentRepository;
use App\Rules\UserTrucker;
use App\Services\ShipmentDocumentService;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Illuminate\Support\Facades\Cache;

class ShipmentsController extends Controller
{

    public function index(ShipmentRepository $shipmentRepository)
    {
        $shipments = Shipment::query()->hydrate(
            Cache::remember('unassigned_shipments', 600, fn () => $shipmentRepository->getShipmentsByStatus(Shipment::STATUS_UNASSIGNED)->toArray())
        );
        $users = SelectOptionsMapper::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
        return view('shipments.index', compact('shipments', 'users'));
    }

    #[Authorize('view-create-shipment-page', Shipment::class)]
    public function create()
    {
        $users = SelectOptionsMapper::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
        $shipmentStatuses = SelectOptionsMapper::toSelectOptions(Shipment::SHIPMENT_STATUSES);
        return view('shipments.create', compact('users', 'shipmentStatuses'));
    }

    #[Authorize('create', Shipment::class)]
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

    #[Authorize('view', 'shipment')]
    public function show(Shipment $shipment)
    {
        $shipment->load('shipmentDocuments');
        return view('shipments.show', compact('shipment'));
    }

    #[Authorize('view-edit-shipment-page', Shipment::class)]
    public function edit(Shipment $shipment)
    {
        $shipmentStatuses = SelectOptionsMapper::toSelectOptions(Shipment::SHIPMENT_STATUSES);
        $users = SelectOptionsMapper::toSelectOptions(User::query()->get()->toArray(), 'name', 'id');
        return view('shipments.edit', compact('shipment', 'shipmentStatuses', 'users'));
    }

    public function update(UpdateShipmentRequest $request, Shipment $shipment)
    {
        $shipment->update($request->validated());
        return redirect()->route('shipments.index');
    }

    public function destroy(Shipment $shipment)
    {
        //
    }

    #[Authorize('update-trucker', 'shipment')]
    public function assignTrucker (Request $request,Shipment $shipment) {
        $validated = $request->validate([
            "user_id_shipment_$shipment->id" => [
                'required',
                'integer',
                new UserTrucker
            ]
        ]);
        $shipment->user_id = $validated["user_id_shipment_$shipment->id"];
        $shipment->status = Shipment::STATUS_IN_PROGRESS;
        $shipment->save();
        return redirect()->route('shipments.index');
    }
}
