<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasTenant, SoftDeletes;

    protected $guarded = [];
    protected $casts   = ['deleted_at' => 'datetime'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->uuid ??= (string) Str::uuid());
    }

    public function orders()    { return $this->hasMany(Order::class); }
    public function addresses() { return $this->hasMany(CustomerAddress::class); }
    public function notes()     { return $this->hasMany(CustomerNote::class); }

    public function primaryAddress()
    {
        return $this->hasOne(CustomerAddress::class)->where('is_primary', true);
    }
}


// ─── Supporting models (small, grouped for brevity) ─────────────────────────

class CustomerAddress extends \Illuminate\Database\Eloquent\Model
{
    use HasTenant;
    protected $guarded = [];
    public function customer() { return $this->belongsTo(Customer::class); }
}

class CustomerNote extends \Illuminate\Database\Eloquent\Model
{
    use HasTenant;
    protected $guarded = [];
    public function customer()  { return $this->belongsTo(Customer::class); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
}