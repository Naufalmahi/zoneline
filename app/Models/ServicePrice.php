<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    protected $guarded = [];
    protected $casts   = ['effective_date' => 'date'];

    public function service() { return $this->belongsTo(Service::class); }
}
