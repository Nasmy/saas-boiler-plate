<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends ApiController
{
    public $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
           $role = $this->roleService->listRole();
           return $this->sendResponse($role, RoleService::MESSAGE_SUCCESS_ROLE_LIST);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function store(RoleRequest $request): JsonResponse
    {
        $request->validated();
        $data = $request->all();

        return $this->roleService->createRole($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $role = $this->roleService->listRoleById($id);
            return $this->sendResponse($role, RoleService::MESSAGE_SUCCESS_ROLE_LIST);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        return $this->roleService->updateRole($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->roleService->deleteRole($id);
    }
}
