<?php

namespace App\Models;

use Database\Factories\ShipmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(name: 'shipments')]
#[Fillable('user_id', 'title', 'from_city', 'from_country', 'to_city', 'to_country', 'price', 'status', 'details')]
#[UseFactory(ShipmentFactory::class)]
class Shipment extends Model
{
    use HasFactory;

    const string STATUS_IN_PROGRESS = 'in_progress';
    const string STATUS_UNASSIGNED = 'unassigned';
    const string STATUS_PROBLEM = 'problem';
    const string STATUS_COMPLETED = 'completed';

    const array SHIPMENT_STATUSES = [
        self::STATUS_COMPLETED,
        self::STATUS_UNASSIGNED,
        self::STATUS_PROBLEM,
        self::STATUS_IN_PROGRESS
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function status(): Attribute {
        return Attribute::make(
            set: fn (string $value) => in_array($value, self::SHIPMENT_STATUSES, true) ? $value : self::STATUS_UNASSIGNED,
        );
    }
}
