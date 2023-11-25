<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\TenantStoreRequest;
use App\Services\TenantService;
use Illuminate\Http\JsonResponse;

class TenantController extends ApiController
{

    public $tenantService;


    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function store(TenantStoreRequest $request): JsonResponse
    {
        $request->validated();
        $data = $request->all();

        $res = $this->tenantService->createTenant($data);

        if (isset($res['is_created']) && $res['is_created']) {
            return $this->sendResponse($res, "successfully registered", 200);
        } else {
            return $this->sendError($res, 401);
        }
    }
}
