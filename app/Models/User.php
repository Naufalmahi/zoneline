<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    protected $guarded = [];
    protected $hidden  = ['password', 'remember_token'];
    protected $casts   = ['email_verified_at' => 'datetime', 'deleted_at' => 'datetime'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(fn($m) => $m->uuid ??= (string) Str::uuid());
    }

    // Helpers
    public function isSuperAdmin(): bool { return is_null($this->tenant_id); }
    public function isOwner(): bool      { return $this->role?->name === 'owner'; }

    // Relationships
    public function tenant()   { return $this->belongsTo(Tenant::class); }
    public function role()     { return $this->belongsTo(Role::class); }
    public function employee() { return $this->hasOne(Employee::class); }
}