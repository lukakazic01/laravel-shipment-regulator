<?php

namespace App\Models;

use Database\Factories\ShipmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(name: 'shipments')]
#[Fillable('user_id', 'title', 'from_city', 'from_country', 'to_city', 'to_country', 'price', 'status', 'details')]
#[UseFactory(ShipmentFactory::class)]
class Shipment extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REJECTED = 'rejected';
    const STATUS_DELIVERED = 'delivered';

    const array SHIPMENT_STATUSES = [
        self::STATUS_CANCELLED,
        self::STATUS_REJECTED,
        self::STATUS_DELIVERED,
        self::STATUS_PENDING
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
