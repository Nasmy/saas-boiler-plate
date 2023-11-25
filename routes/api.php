<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use App\Http\Controllers\API;
use App\Http\Controllers\Api\RoleBkController;
use App\Http\Controllers\Api\PermissionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** Tenant Api Routes */
Route::post('tenant/register', [API\TenantController::class, 'store']);

Route::group([
    'prefix' => '/' . env('API_VERSION') . '/{tenant}',
    'middleware' => [InitializeTenancyByPath::class],
], function () {
    Route::post('auth', [API\AuthController::class, 'login']);
});

Route::group([
    'prefix' => '/' . env('API_VERSION') . '/{tenant}',
    'middleware' => [InitializeTenancyByPath::class, 'auth:sanctum'],
], function () {
    Route::apiResource('roles', API\RoleController::class)->middleware('authorize');
    Route::apiResource('users', API\UserController::class)->middleware('authorize');
});
