<?php

namespace App\Models;

use Database\Factories\ShipmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table(name: 'shipments')]
#[Fillable('user_id', 'title', 'from_city', 'from_country', 'to_city', 'to_country', 'price', 'status', 'details')]
#[UseFactory(ShipmentFactory::class)]
class Shipment extends Model
{
    use HasFactory;
}
