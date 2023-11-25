<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantStoreRequest;
use App\Models\Role;
use App\Services\TenantService;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class RegisterController extends Controller
{
    public $tenantService;


    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function store(TenantStoreRequest $request) {
        $request->validated();
        $data = $request->all();
        $data['role_id'] = Role::DEFAULT_TENANT_ROLE_ID;
        $res = $this->tenantService->createTenant($data);
        try {
            if (isset($res['is_created']) && $res['is_created']) {
                return redirect('admin/dashboard');
            }
            if(isset($res['error'])) {
                return back()->withErrors($res['error'])->withInput();
            }
        } catch (Exception $e) {
            return back()->withErrors($e->getErrors())->withInput();
        }
    }
}
