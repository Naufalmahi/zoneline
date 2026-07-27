<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('plans');
            $table->datetime('starts_at');
            $table->datetime('ends_at')->nullable();        // NULL = lifetime/ongoing
            $table->string('status', 20)->default('Trial'); // Trial, Active, Expired, Cancelled
            $table->timestamps();

            $table->index(['tenant_id', 'status']);
        });

        Schema::create('subscription_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('plans');
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->string('status', 20);                  // Paid, Refunded, Failed
            $table->string('payment_reference', 100)->nullable();
            $table->datetime('subscribed_at');
            $table->timestamps();

            $table->index('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_histories');
        Schema::dropIfExists('tenant_subscriptions');
    }
};
