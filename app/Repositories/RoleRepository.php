<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::all();
    }

    public function getAllRolesByIndent($ident)
    {
        return Role::where('ident', $ident)->get();
    }

    public function getAllRolesByName($name)
    {
        return Role::where('name', $name)->get();
    }

    public function getAllRolesById($id)
    {
        return Role::find($id);
    }

    public function createRolePermissions($roleData, $permissionList)
    {
        $role = Role::create($roleData);
        $role->permissions()->sync($permissionList); // Add data to role permission table
        return $role;
    }

    public function createOrUpdate($id = null, $data = []): Role
    {
        $role = Role::updateOrCreate(['id' => $id], $data);
        $role->permissions()->sync($data['permissions']);
        return $role;
    }

    public function delete($id)
    {
        $role = Role::find($id);
        return $role->delete();
    }
}
