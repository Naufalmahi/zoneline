<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasTenant, SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'received_at'          => 'datetime',
        'estimated_finish_at'  => 'datetime',
        'finished_at'          => 'datetime',
        'picked_up_at'         => 'datetime',
        'deleted_at'           => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->uuid ??= (string) Str::uuid());
    }

    // Relationships
    public function tenant()      { return $this->belongsTo(Tenant::class); }
    public function customer()    { return $this->belongsTo(Customer::class); }
    public function employee()    { return $this->belongsTo(User::class, 'employee_id'); }
    public function status()      { return $this->belongsTo(OrderStatus::class, 'status_id'); }
    public function details()     { return $this->hasMany(OrderDetail::class); }
    public function statusLogs()  { return $this->hasMany(OrderStatusLog::class)->latest(); }
    public function photos()      { return $this->hasMany(OrderPhoto::class); }
    public function payments()    { return $this->hasMany(Payment::class); }

    // Tracking URL publik
    public function getTrackingUrlAttribute(): string
    {
        return route('tracking.show', $this->uuid);
    }
}