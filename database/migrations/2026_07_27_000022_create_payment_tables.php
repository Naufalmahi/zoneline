<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->string('payment_method_name', 50); // Snapshot nama metode
            $table->decimal('amount_paid', 12, 2);
            $table->decimal('change_amount', 12, 2)->default(0); // Kembalian
            $table->string('reference_number', 100)->nullable(); // Nomor transfer/QRIS
            $table->foreignId('received_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->datetime('paid_at');
            $table->timestamps();

            $table->index('tenant_id');
            $table->index('order_id');
        });

        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->string('action', 50);       // created, verified, refunded
            $table->text('description')->nullable();
            $table->foreignId('performed_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();

            $table->index('payment_id');
        });

        Schema::create('payment_refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->decimal('refund_amount', 12, 2);
            $table->string('reason', 255)->nullable();
            $table->string('status', 20)->default('Pending'); // Pending, Approved, Rejected
            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->datetime('refunded_at')->nullable();
            $table->timestamps();

            $table->index('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_refunds');
        Schema::dropIfExists('payment_logs');
        Schema::dropIfExists('payments');
    }
};
