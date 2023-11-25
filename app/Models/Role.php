<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const DEFAULT_ROLE = "administrator";
    const DEFAULT_ADMIN_ROLE_ID = 1;
    const TENANT_ROLE = "tenant";
    const DEFAULT_TENANT_ROLE_ID = 2;
    const ROLE_ACTIVE = true;
    const ROLE_INACTIVE = false;

    protected $table = 'roles';
    protected $fillable = ['name','ident', 'description', 'active'];

    // protected $casts = ['active' => 'bool'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

}
