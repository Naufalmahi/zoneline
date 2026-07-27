<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('member_code', 20);         // CUS0001, CUS0002 (auto-generated)
            $table->string('name', 150);
            $table->string('phone', 20)->nullable();   // Nomor WhatsApp
            $table->string('email', 150)->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('total_orders')->default(0);   // Cached counter
            $table->decimal('total_spending', 14, 2)->default(0);  // Cached sum
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['tenant_id', 'member_code']);
            $table->index(['tenant_id', 'phone']);
            $table->index('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
