<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /** Default Permission **/

    const DEFAULT_DASHBOARD_PERMISSION = 'dashboard.index';

    protected $table = 'permissions';
    protected $fillable = ['name','parent','child','ident', 'description', 'active'];

    protected $casts = ['active' => 'bool'];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
