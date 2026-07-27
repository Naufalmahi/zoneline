<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tenant extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = ['deleted_at' => 'datetime'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid ??= (string) Str::uuid();
        });
    }

    // Relationships
    public function users()               { return $this->hasMany(User::class); }
    public function settings()            { return $this->hasOne(TenantSetting::class); }
    public function subscription()        { return $this->hasOne(TenantSubscription::class)->latestOfMany(); }
    public function customers()           { return $this->hasMany(Customer::class); }
    public function services()            { return $this->hasMany(Service::class); }
    public function orders()              { return $this->hasMany(Order::class); }
    public function orderStatuses()       { return $this->hasMany(OrderStatus::class)->orderBy('sequence'); }
    public function paymentMethods()      { return $this->hasMany(PaymentMethod::class); }
    public function employees()           { return $this->hasMany(Employee::class); }
}