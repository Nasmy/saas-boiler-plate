<?php

namespace App\Services;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RoleService
{
    use ApiResponse;

    // Response success messages
    const MESSAGE_SUCCESS_ROLE_LIST = "Role Lists";
    const MESSAGE_SUCCESS_ROLE_CREATE = "Successfully created roles";


    public $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function listRole()
    {
        return $this->roleRepository->getAllRoles();
    }

    public function listRoleById($id)
    {
        return $this->roleRepository->getAllRolesById($id);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function createRole($data): JsonResponse
    {
        $pdo = DB::connection()->getPdo();
        try {
            $pdo->beginTransaction();
            $roleData = [
                'name' => $data['name'],
                'ident' => $data['ident'],
                'description' => $data['description'],
                'active' => Role::ROLE_ACTIVE,
                'permissions' => $data['permissions']
            ];
            $roleData = $this->roleRepository->createOrUpdate(null, $roleData);
            $pdo->commit();
            return $this->sendResponse($roleData, 'Successfully Created');
        } catch (\Exception $e) {
            $pdo->rollBack();
            return $this->sendError($e->getMessage(), '401');
        }
    }

    public function updateRole($id, $data): JsonResponse
    {
        $pdo = DB::connection()->getPdo();
        try {
            $pdo->beginTransaction();
            $roleData = [
                'name' => $data['name'],
                'ident' => $data['ident'],
                'description' => $data['description'],
                'active' => Role::ROLE_ACTIVE,
                'permissions' => $data['permissions']
            ];
            $roleData = $this->roleRepository->createOrUpdate($id, $roleData);
            $pdo->commit();
            return $this->sendResponse($roleData, 'Successfully Created');
        } catch (\Exception $e) {
            $pdo->rollBack();
            return $this->sendError($e->getMessage(), '401');
        }
    }

    public function deleteRole($id): JsonResponse
    {
        try {
            $role = $this->roleRepository->delete($id);
            return $this->sendResponse($role, 'Role successfully deleted ');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), '401');
        }
    }

}
