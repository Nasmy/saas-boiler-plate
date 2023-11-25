<?php

namespace App\Http\Controllers\API;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    public $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    public function login(Request $request): JsonResponse
    {
        return $this->authService->restUserLogin(['username' => $request->input('username'), 'password' => $request->input('password')]);
    }
}
