<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasTenant, SoftDeletes;
    protected $guarded = [];
    protected $casts   = ['joined_at' => 'date'];

    public function user()        { return $this->belongsTo(User::class); }
    public function attendances() { return $this->hasMany(EmployeeAttendance::class); }
}
