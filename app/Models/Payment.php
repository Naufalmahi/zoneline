<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasTenant;
    protected $guarded = [];
    protected $casts   = ['paid_at' => 'datetime'];

    public function order()         { return $this->belongsTo(Order::class); }
    public function paymentMethod() { return $this->belongsTo(PaymentMethod::class); }
    public function receivedBy()    { return $this->belongsTo(User::class, 'received_by'); }
    public function logs()          { return $this->hasMany(PaymentLog::class); }
    public function refunds()       { return $this->hasMany(PaymentRefund::class); }
}
