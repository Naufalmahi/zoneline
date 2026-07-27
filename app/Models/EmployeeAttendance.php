<?php

namespace App\Models;

use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasTenant;
    protected $guarded = [];
    protected $casts   = ['date' => 'date'];

    public function employee() { return $this->belongsTo(Employee::class); }
}
