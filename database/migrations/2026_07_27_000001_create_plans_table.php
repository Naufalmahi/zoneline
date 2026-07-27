<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);                    // Free, Basic, Pro, Business
            $table->string('slug', 50)->unique();
            $table->decimal('price', 12, 2)->default(0);   // Rp/bulan
            $table->unsignedInteger('max_orders')->default(0);    // 0 = unlimited
            $table->unsignedInteger('max_employees')->default(1);
            $table->unsignedInteger('trial_days')->default(14);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
