<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->string('type', 50)->nullable(); // order, payment, system, promo
            $table->string('title', 200);
            $table->text('message');
            $table->json('data')->nullable();        // Payload tambahan (order_id, dsb)
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['tenant_id', 'is_read']);
            $table->index(['user_id', 'is_read']);
        });

        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('channel', 30);          // whatsapp, email, in_app
            $table->string('recipient', 150);       // nomor/email penerima
            $table->string('status', 20);           // Sent, Failed, Pending
            $table->text('message');
            $table->text('response')->nullable();   // Response dari gateway WA/Email
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
        Schema::dropIfExists('notifications');
    }
};
