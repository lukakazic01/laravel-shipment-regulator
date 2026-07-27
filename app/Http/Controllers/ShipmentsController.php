<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

    public function store(Request $request)
    {
        dd($request->all());
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
