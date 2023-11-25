<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends ApiController
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->userService->listUser();
            return $this->sendResponse($data, "User list");
        } catch(\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $data = $request->all();
            $data['is_admin'] = User::NOT_ADMIN;
            $user = $this->userService->createUser($data);
            return $this->sendResponse($user, 'User created successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $data = $this->userService->listUserById($id);
            $this->sendResponse($data, "User Info");
        } catch(\Exception $e) {
            $this->sendError($e->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $userData = $request->all();
            $data = $this->userService->updateUser($id, $userData);
            return $this->sendResponse($data, "successfully updated");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->userService->deleteUser($id);
            return $this->sendResponse($id, "successfully deleted");
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }
}
