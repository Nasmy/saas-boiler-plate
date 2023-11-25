<?php

namespace App\Services;

use App\Interfaces\TenantRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class TenantService
{
    use ApiResponse;

    public $userRepository;
    public $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * @param $data
     * @return array
     */
    public function createTenant($data): array
    {
        $response = [];
        $data['password'] = UserService::hashPassword($data['password']);
        $tenantId = $data['username'];
        $domainName = TenantService::generateDomainName($tenantId);

        try {
            $pdo = DB::connection()->getPdo();
            $pdo->beginTransaction();
            $user = $this->userRepository->create($data);
            $user['is_admin'] = Role::DEFAULT_ADMIN_ROLE_ID;
            $tenant = $this->tenantRepository->createTenant($tenantId, $user);
            $this->tenantRepository->createDomain($tenant, $domainName);
            $response['token'] = AuthService::generateAuthToken($user, AuthService::TOKEN_API);
            $response['first_name'] = $user->last_name;
            DB::commit();
            $response['is_created'] = true;
            return $response;
        } catch (\Exception $e) {
            DB::rollBack();
            $response['error'] = $e->getMessage();
            return $response;
        }
    }

    /**
     * @param $userName
     * @return string
     */
    public static function generateDomainName($userName): string
    {
        return $userName . '.' . env('APP_TENANT_DOMAIN');
    }
}
