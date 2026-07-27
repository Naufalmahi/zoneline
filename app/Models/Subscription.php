<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTenant;

class Subscription extends Model
{
    use HasTenant;
    protected $guarded = [];

    public function plan() { return $this->belongsTo(Plan::class); }
}