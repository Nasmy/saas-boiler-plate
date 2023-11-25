<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRecord('Dashboard', Permission::DEFAULT_DASHBOARD_PERMISSION, 'admin', true);
    }

    private function createRecord(string $name, string $ident, string $description, bool $active)
    {
        Permission::create([
            'name' => $name,
            'ident' => $ident,
            'description' => $description,
            'active' => $active
        ]);
    }
}
