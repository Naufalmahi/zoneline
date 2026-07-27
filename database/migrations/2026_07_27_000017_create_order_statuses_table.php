<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tidak pakai ENUM — owner bisa tambah status sendiri tanpa perlu migrate DB
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('name', 50);        // Received, Sorting, Washing, Drying, ...
            $table->string('slug', 50);        // received, sorting, washing
            $table->string('color_hex', 7)->default('#6366f1'); // Warna label UI
            $table->string('icon', 50)->nullable();
            $table->unsignedInteger('sequence')->default(0); // Urutan 1, 2, 3 ...
            $table->boolean('is_final')->default(false);  // Picked Up, Cancelled = final
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['tenant_id', 'slug']);
            $table->index(['tenant_id', 'sequence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
};
