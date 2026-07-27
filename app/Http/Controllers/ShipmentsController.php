<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentsController extends Controller
{

    public function index()
    {
        return view('shipments.index');
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
