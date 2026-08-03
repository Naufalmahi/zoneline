<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenant_settings', function (Blueprint $table) {
            $table->string('tagline', 255)->nullable()->after('business_name');
            $table->boolean('show_whatsapp_button')->default(true)->after('whatsapp_number');
        });
    }

    public function down(): void
    {
        Schema::table('tenant_settings', function (Blueprint $table) {
            $table->dropColumn(['tagline', 'show_whatsapp_button']);
        });
    }
};
