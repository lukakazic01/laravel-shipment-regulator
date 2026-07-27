<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use JetBrains\PhpStorm\NoReturn;

class ShipmentsController extends Controller
{

    public function index()
    {
        $shipments = Shipment::query()->hydrate(
            Cache::remember('shipments', 3600, function () {
                return Shipment::all()->where('user_id', auth()->id())->toArray();
            })
        );
        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        return view('shipments.create');
    }

    #[NoReturn]
    public function store(CreateShipmentRequest $request)
    {
        //
    }

    public function show(Shipment $shipment)
    {
        //
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
