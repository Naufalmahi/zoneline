<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $casts   = ['created_at' => 'datetime'];

    public function order()     { return $this->belongsTo(Order::class); }
    public function status()    { return $this->belongsTo(OrderStatus::class); }
    public function changedBy() { return $this->belongsTo(User::class, 'changed_by'); }
}
