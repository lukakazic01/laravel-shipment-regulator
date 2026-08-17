<?php

namespace App\Repositories;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

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
        return Shipment::byStatus($status)->get();
    }

    /**
     * @param mixed $validatedData
     * @return Shipment
     */
    public function createShipment(mixed $validatedData): Shipment
    {
        $snakeCasedValidatedData = collect($validatedData)->mapWithKeys(fn ($value, $key) => [Str::snake($key) => $value])->toArray();
        return Shipment::query()->create($snakeCasedValidatedData);
    }

}
