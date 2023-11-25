<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface
{
    public function getAllPermissions();
    public function getAllPermissionsByIdent($ident);
    public function getAllPermissionsByName($name);
    public function getAllPermissionsById($id);
    public function createOrUpdate($id = null, $collection = []);
    public function deletePermission($id);
}
