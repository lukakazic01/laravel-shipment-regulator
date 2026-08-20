<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipment;
use App\Rules\UserTrucker;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Authorize;

class ShipmentsController extends Controller
{

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
