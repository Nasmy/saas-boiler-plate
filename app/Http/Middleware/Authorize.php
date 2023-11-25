<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authorize
{
    use ApiResponse;

    public $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $permissionName = Route::getCurrentRoute()->action['as'];
        $role_id = $request->user()->role_id;
        $isAuthorize = $this->authService->checkAuthorize($role_id, $permissionName);
        if ($isAuthorize) {
            return $next($request);
        } else {
            return $this->sendError('Authorisation Failed', 401);
        }
    }
}
