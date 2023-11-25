<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAllPermissions()
    {
        return Permission::all();
    }
    public function getAllPermissionsByIdent($ident)
    {
        return Permission::where('ident', $ident)->first();
    }
    public function getAllPermissionsByName($name)
    {
    }
    public function getAllPermissionsById($id)
    {
    }
    public function createOrUpdate($id = null, $collection = [])
    {
    }
    public function deletePermission($id)
    {
    }
}
