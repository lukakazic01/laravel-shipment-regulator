<?php

namespace App\Repositories;

use App\Http\Requests\CreateShipmentRequest;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Collection;

class ShipmentRepository
{

    public function __construct(
        public Shipment $shipment,
    ){}

    /**
     * @return Collection<int, Shipment>
     */
    public function getShipmentsOfAuthenticatedUser(): Collection
    {
        return Shipment::query()->where('user_id', auth()->id())->get();
    }

    public function createShipment(CreateShipmentRequest $request): void
    {
        $request->user()->shipments()->create($request->validated());
    }

}
