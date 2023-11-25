<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function getAllRolesByIndent($ident);
    public function getAllRolesByName($name);
    public function getAllRolesById($id);
    public function createRolePermissions($roleData, $permissionList);
    public function createOrUpdate($id, $data);
    public function delete($id);
}
