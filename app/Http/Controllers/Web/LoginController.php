<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Services\AuthService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index() {
        return view('front-end.auth.login');
    }

    /**
     * @description the login form validate both ways. Admin User Or Tenant User
     * @param LoginFormRequest $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function authenticate(LoginFormRequest $request)
    {
        try {
            $request->validated();
            return $this->authService->webUserLogin(['username' => $request->input('username'), 'password' => $request->input('password')], $request->input('login_method'));
        } catch (\Exception $exception) {

        }
    }

    /**
     * @description check whether logout from admin portal or tenant dashboard. This will redirect according to route path
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(Request $request) {
        Auth::logout();
        if($request->is('admin/*')) {
            return redirect('/admin/login');
        }
        return redirect('/login');
    }
}
