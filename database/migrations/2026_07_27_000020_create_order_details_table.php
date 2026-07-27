<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // price_at_that_time = snapshot harga saat order dibuat
        // Aman meski harga service berubah di masa depan
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services');
            $table->string('service_name', 100);           // Snapshot nama service
            $table->string('unit_type', 20)->default('KG');// Snapshot unit saat itu
            $table->decimal('qty', 8, 2)->default(1);      // Berat (kg) atau jumlah (pcs)
            $table->decimal('price_at_that_time', 12, 2);  // Snapshot harga per unit
            $table->decimal('total_price', 12, 2);         // qty * price_at_that_time
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
