<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barbershop_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('name', 100);
            $table->decimal('price', 12, 2);
            $table->integer('duration_minutes')->default(30);
            $table->timestamps();
        });

        Schema::create('barbershop_barbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('phone', 20)->nullable();
            $table->string('status', 20)->default('Active');
            $table->timestamps();
        });

        Schema::create('barbershop_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('barber_id')->nullable()->constrained('barbershop_barbers')->nullOnDelete();
            $table->foreignId('service_id')->constrained('barbershop_services')->cascadeOnDelete();
            $table->string('customer_name', 100);
            $table->string('customer_phone', 20);
            $table->dateTime('booking_time');
            $table->string('status', 20)->default('Pending'); // Pending, Confirmed, Completed, Cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barbershop_bookings');
        Schema::dropIfExists('barbershop_barbers');
        Schema::dropIfExists('barbershop_services');
    }
};
