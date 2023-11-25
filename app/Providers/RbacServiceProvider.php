<?php

namespace App\Providers;


use App\Repositories\PermissionRepository;
use App\Services\PermissionService;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class RbacServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(PermissionRepository $permission, PermissionService $permissionService)
    {
        // $permission = $permission->getAllPermissions()->pluck('ident');
    }
}
