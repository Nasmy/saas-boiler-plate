<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class TenantRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRecord('Admin', Role::DEFAULT_ROLE, 'admin', true);
    }

    private function createRecord(string $name, string $ident, string $description, bool $active) {
        Role::create([
            'name' => $name,
            'ident' => $ident,
            'description' => $description,
            'active' => $active
        ]);
    }
}
