<?php

use App\Models\Shipment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('status', 20)->default(Shipment::STATUS_UNASSIGNED)->change();
            $table->foreignId('user_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('status')->default(Shipment::STATUS_IN_PROGRESS)->change();
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }

};
