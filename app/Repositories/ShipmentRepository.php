<?php

namespace App\Repositories;

use App\Http\Requests\CreateShipmentRequest;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function getShipmentsByStatus(string $status): Collection {
        return Shipment::query()->where('status', $status)->get();
    }

    /**
     * @param CreateShipmentRequest $request
     * @return Model<Shipment>
     */
    public function createShipment(CreateShipmentRequest $request): Model
    {
        return $request->user()->shipments()->create($request->validated());
    }

}
