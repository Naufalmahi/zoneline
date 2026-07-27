<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTenant;

class PaymentTransaction extends Model
{
    use HasTenant;
    protected $guarded = [];
    protected $table = 'payments_transactions';

    public function order() { return $this->belongsTo(Order::class); }
}