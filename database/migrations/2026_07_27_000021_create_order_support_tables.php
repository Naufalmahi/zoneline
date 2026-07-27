<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Audit trail lengkap: jam berapa, siapa yang mengubah, ke status apa
        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->string('status_name', 50);   // Snapshot nama status
            $table->foreignId('changed_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->string('changed_by_name', 100)->nullable(); // Snapshot nama
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('order_id');
            $table->index(['order_id', 'created_at']);
        });

        // Foto pakaian sebelum diproses (bukti kondisi awal)
        Schema::create('order_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('photo_path', 255);
            $table->string('photo_type', 30)->default('before'); // before, after
            $table->text('description')->nullable();
            $table->foreignId('uploaded_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamps();

            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_photos');
        Schema::dropIfExists('order_status_logs');
    }
};
