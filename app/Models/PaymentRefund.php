<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class PaymentRefund extends Model
{
    use HasTenant;
    protected $guarded = [];
    protected $casts   = ['refunded_at' => 'datetime'];

    public function payment()    { return $this->belongsTo(Payment::class); }
    public function approvedBy() { return $this->belongsTo(User::class, 'approved_by'); }
}
