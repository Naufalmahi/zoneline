<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menyimpan riwayat harga, sehingga harga lama pada order lama tidak berubah
        Schema::create('service_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->decimal('price', 12, 2);        // Harga per KG atau per PCS
            $table->date('effective_date');          // Berlaku mulai tanggal ini
            $table->text('notes')->nullable();       // Alasan perubahan harga
            $table->timestamps();

            $table->index(['service_id', 'effective_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_prices');
    }
};
