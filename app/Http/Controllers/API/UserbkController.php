<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\UserStoreRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserbkController extends ApiController
{
    public $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $request->validated();
        $data = $request->all();
        $data['is_admin'] = User::NOT_ADMIN;
        try {
            $user = $this->userRepository->create($data);
            return $this->sendResponse($user, 'User created successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
            $user  = $this->userRepository->updateUser($id, $request->all());
            return $this->sendResponse($user, 'User successfully updated');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        try {
            $this->userRepository->deleteUser($id, true);
            return $this->sendResponse([], 'Successfully Deleted', 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }

    }
}
