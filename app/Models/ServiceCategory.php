<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasTenant;
    protected $guarded = [];

    public function services() { return $this->hasMany(Service::class, 'category_id'); }
}
