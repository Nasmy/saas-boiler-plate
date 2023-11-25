<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\Frontend\DashboardController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::group([
    'middleware' => [InitializeTenancyByDomain::class, 'web', 'guest'],
], function () {
    Route::get('/', function () {
        return redirect('login');
    });
    // Route::view('login','front-end.auth.login')->name('login');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('front-authenticate');
});

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'auth',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('logout', [LoginController::class, 'logout']);

    Route::resource('/roles', \App\Http\Controllers\Web\Frontend\RoleController::class);
});
