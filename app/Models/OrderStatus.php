<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasTenant;
    protected $guarded = [];

    public function orders() { return $this->hasMany(Order::class, 'status_id'); }
}
