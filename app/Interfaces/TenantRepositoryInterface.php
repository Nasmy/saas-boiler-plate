<?php

namespace App\Interfaces;

interface TenantRepositoryInterface
{
    public function createTenant($tenantId, $user);
    public function createDomain($tenant, $tenantDomain);
}
