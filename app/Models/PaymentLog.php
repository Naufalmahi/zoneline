<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $casts   = ['created_at' => 'datetime'];

    public function payment() { return $this->belongsTo(Payment::class); }
}
