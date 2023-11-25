<?php

namespace App\Services;

use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ApiResponse;

    const TOKEN_API = "rest_auth_token";
    const LOGIN_METHOD_FRONT = 1;

    public $userRepository;
    public $roleRepository;
    public $permissionRepository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }


    public function restUserLogin($authAttempt)
    {
        if (Auth::attempt($authAttempt)) {
            $user = Auth::user();
            $response['token'] = self::generateAuthToken($user, self::TOKEN_API);
            $response['name'] = $user->last_name;
            return $this->sendResponse($response, "Successfully legged in");
        } else {
            return $this->sendError("Invalid Credentials", 401);
        }
    }

    /**
     * @param $authAttempt
     * @return Application|RedirectResponse|Redirector
     */
    public function webUserLogin($authAttempt, $loginMethod)
    {
        if (Auth::attempt($authAttempt)) {
            $user = Auth::user();
            Auth::login($user);
            return $loginMethod == "tenant" ? redirect('/dashboard') : redirect('admin/dashboard');
        } else {
            session()->flash('login-invalid-message', 'Invalid credentials');
            return back();
        }
    }

    /**
     * @param $roleId
     * @param $permission
     * @return bool
     */
    public function checkAuthorize($roleId, $permission): bool
    {
        $permissionData = $this->permissionRepository->getAllPermissionsByIdent($permission);
        if ($permissionData == null || $permissionData->count() <= 0) {
            return false;
        }

        $permissionId = $permissionData->id;
        $role = $this->roleRepository->getAllRolesById($roleId);

        $rolePermission = $role->permissions()->where('permission_id', $permissionId)->get();
        if ($this->isAdmin($roleId) || count($rolePermission) >= 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $roleId
     * @return bool
     */
    public function isAdmin($roleId): bool
    {
        if ($roleId == Role::DEFAULT_ADMIN_ROLE_ID) {
            return true;
        }
        return false;
    }


    /**
     * @param $user
     * @param $tokenName
     * @return mixed
     */
    public static function generateAuthToken($user, $tokenName)
    {
        return $user->createToken($tokenName);
    }
}
