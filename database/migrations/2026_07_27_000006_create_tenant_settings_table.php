<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Dibuat otomatis saat Tenant baru register dengan default values
        Schema::create('tenant_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('business_name', 150)->nullable();
            $table->string('logo', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('timezone', 50)->default('Asia/Jakarta');
            $table->string('currency', 10)->default('IDR');
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->string('qris_image', 255)->nullable();
            $table->string('printer_type', 50)->default('Thermal 58mm');
            $table->json('operating_hours')->nullable();  // {"mon": "08:00-20:00", ...}
            $table->string('invoice_prefix', 20)->default('INV');
            $table->boolean('whatsapp_notif')->default(false);
            $table->string('whatsapp_number', 20)->nullable();
            $table->timestamps();

            $table->unique('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_settings');
    }
};
