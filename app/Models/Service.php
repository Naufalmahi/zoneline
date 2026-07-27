<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasTenant;
    protected $guarded = [];

    public function category()      { return $this->belongsTo(ServiceCategory::class, 'category_id'); }
    public function prices()        { return $this->hasMany(ServicePrice::class)->orderByDesc('effective_date'); }
    public function currentPrice()  { return $this->hasOne(ServicePrice::class)->latestOfMany('effective_date'); }
}