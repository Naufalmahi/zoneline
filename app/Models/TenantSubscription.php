<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class TenantSubscription extends Model
{
    use HasTenant;
    protected $guarded = [];
    protected $casts   = ['starts_at' => 'datetime', 'ends_at' => 'datetime'];

    public function plan() { return $this->belongsTo(Plan::class); }

    public function isActive(): bool
    {
        return $this->status === 'Active' && ($this->ends_at === null || $this->ends_at->isFuture());
    }
}
