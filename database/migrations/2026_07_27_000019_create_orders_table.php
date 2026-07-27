<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();   // Dipakai di URL tracking: /track/{uuid}
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('invoice_number', 30);   // INV-2026-001 (unik per tenant)
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('employee_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->foreignId('status_id')
                  ->nullable()
                  ->constrained('order_statuses')
                  ->nullOnDelete();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->string('payment_status', 20)->default('Unpaid'); // Unpaid, Partial, Paid
            $table->datetime('received_at');
            $table->datetime('estimated_finish_at')->nullable();
            $table->datetime('finished_at')->nullable();
            $table->datetime('picked_up_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['tenant_id', 'invoice_number']);
            $table->index('tenant_id');
            $table->index(['tenant_id', 'payment_status']);
            $table->index(['tenant_id', 'status_id']);
            $table->index('uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
