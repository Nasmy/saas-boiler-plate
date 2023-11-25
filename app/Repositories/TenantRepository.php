<?php

namespace App\Repositories;

use App\Interfaces\TenantRepositoryInterface;
use App\Models\Role;
use App\Models\Tenant;

class TenantRepository implements TenantRepositoryInterface
{
    public function createDomain($tenant, $tenantDomain)
    {
        return $tenant->domains()->create(['domain' => $tenantDomain, 'user_id' => $tenant['user_id']]);
    }

    public function createTenant($tenantId, $user)
    {
        $tenantUser = [
            'id' => $user['username'],
            'user_id' => $user->id,
            'first_name' => $user['first_name'],
            'last_name' => $user['first_name'],
            'mobile' => $user['mobile'],
            'email' => $user['email'],
            'username' => $user['username'],
            'city' => $user['city'],
            'zip' => $user['zip'],
            'role_id' => Role::DEFAULT_ADMIN_ROLE_ID,
            'is_admin' => $user['is_admin'],
            'password' => $user['password'],
            'address' => $user['address'],
        ];

        return Tenant::create($tenantUser);
    }
}
