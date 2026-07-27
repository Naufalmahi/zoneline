<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * HasTenant — Global Scope untuk Multi-Tenant.
 *
 * Cara kerja:
 * 1. Setiap query SELECT otomatis menambahkan WHERE tenant_id = auth()->user()->tenant_id
 * 2. Setiap INSERT otomatis mengisi kolom tenant_id
 * 3. Super Admin (tenant_id = null) dikecualikan dari filter
 */
trait HasTenant
{
    protected static function bootHasTenant(): void
    {
        // Auto-filter query berdasarkan tenant_id user yang login
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $builder->where(
                    $builder->getModel()->getTable() . '.tenant_id',
                    auth()->user()->tenant_id
                );
            }
        });

        // Auto-isi tenant_id saat membuat record baru
        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->tenant_id && empty($model->tenant_id)) {
                $model->tenant_id = auth()->user()->tenant_id;
            }
        });
    }

    /**
     * Scope untuk query tanpa filter tenant (dipakai Super Admin).
     */
    public function scopeWithoutTenantScope(Builder $query): Builder
    {
        return $query->withoutGlobalScope('tenant');
    }
}