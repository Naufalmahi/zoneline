<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->date('report_date');
            $table->unsignedInteger('total_orders')->default(0);
            $table->unsignedInteger('completed_orders')->default(0);
            $table->unsignedInteger('cancelled_orders')->default(0);
            $table->unsignedInteger('new_customers')->default(0);
            $table->decimal('total_revenue', 14, 2)->default(0);
            $table->decimal('total_discount', 14, 2)->default(0);
            $table->decimal('total_tax', 14, 2)->default(0);
            $table->timestamps();

            $table->unique(['tenant_id', 'report_date']);
            $table->index('tenant_id');
        });

        Schema::create('monthly_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->unsignedTinyInteger('month');   // 1-12
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('total_orders')->default(0);
            $table->unsignedInteger('completed_orders')->default(0);
            $table->unsignedInteger('new_customers')->default(0);
            $table->decimal('total_revenue', 14, 2)->default(0);
            $table->timestamps();

            $table->unique(['tenant_id', 'month', 'year']);
            $table->index('tenant_id');
        });

        Schema::create('yearly_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('total_orders')->default(0);
            $table->unsignedInteger('total_customers')->default(0);
            $table->decimal('total_revenue', 14, 2)->default(0);
            $table->timestamps();

            $table->unique(['tenant_id', 'year']);
            $table->index('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yearly_reports');
        Schema::dropIfExists('monthly_reports');
        Schema::dropIfExists('daily_reports');
    }
};
