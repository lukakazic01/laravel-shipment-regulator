<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(name: 'shipment_documents')]
#[Fillable(['document_name', 'shipment_id'])]
class ShipmentDocument extends Model
{

    public function shipment(): BelongsTo {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

}
