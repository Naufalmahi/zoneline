<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coffee_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('name', 100);
            $table->timestamps();
        });

        Schema::create('coffee_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('coffee_categories')->nullOnDelete();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->string('image', 255)->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });

        Schema::create('coffee_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('name', 50); // e.g. "Meja 1", "VIP 1"
            $table->integer('capacity')->default(2);
            $table->string('status', 20)->default('Available'); // Available, Occupied, Reserved
            $table->timestamps();
        });

        Schema::create('coffee_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('table_id')->constrained('coffee_tables')->cascadeOnDelete();
            $table->string('customer_name', 100);
            $table->string('customer_phone', 20);
            $table->dateTime('reservation_time');
            $table->string('status', 20)->default('Pending'); // Pending, Confirmed, Completed, Cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coffee_reservations');
        Schema::dropIfExists('coffee_tables');
        Schema::dropIfExists('coffee_menus');
        Schema::dropIfExists('coffee_categories');
    }
};
