<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $search = $request->all();
        $search['role_id'] = Role::DEFAULT_TENANT_ROLE_ID;

        $tenants = $this->userRepository->search($search);

        return view('dashboard.main', ['tenants' => $tenants]);
    }
}
