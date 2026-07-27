<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTenant;

class StatusHistory extends Model
{
    use HasTenant;
    protected $guarded = [];

    public function order() { return $this->belongsTo(Order::class); }
    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by'); }
}