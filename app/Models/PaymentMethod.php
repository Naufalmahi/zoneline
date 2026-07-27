<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasTenant;
    protected $guarded = [];
}
