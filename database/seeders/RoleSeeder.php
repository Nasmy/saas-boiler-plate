<?php

namespace Database\Seeders;


use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRecord('Admin', Role::DEFAULT_ROLE, 'admin', true);
        $this->createRecord('Tenant', Role::TENANT_ROLE, 'tenant', true);
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
