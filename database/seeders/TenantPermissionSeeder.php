<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class TenantPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionList = PermissionService::getPermissions();

        foreach ($permissionList as $permission) {
            $name = $permission['name'];
            $parent = $permission['parent'];
            $child = $permission['child'];
            $description = $permission['description'];
            $active = $permission['active'];
            foreach ($permission['ident'] as $ident) {
                $ident = $child.".".$ident;
                $this->createRecord($name, $parent, $child, $ident, $description, $active);
            }
        }
    }

    private function createRecord(string $name, string $parent, string $child, string $ident, string $description, bool $active)
    {
        Permission::create([
            'name' => $name,
            'parent' => $parent,
            'child' => $child,
            'ident' => $ident,
            'description' => $description,
            'active' => $active
        ]);
    }

}
