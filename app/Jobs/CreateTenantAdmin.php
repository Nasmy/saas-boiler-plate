<?php

namespace App\Jobs;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateTenantAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tenant;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->tenant->run(function ($tenant) {
            $users = [
                'first_name' => $tenant->first_name,
                'last_name'=> $tenant->first_name,
                'mobile' => $tenant->mobile,
                'email' => $tenant->email,
                'username'=> $tenant->username,
                'country' => $tenant->country,
                'city' => $tenant->city,
                'zip' => $tenant->zip,
                'role_id' => Role::DEFAULT_ADMIN_ROLE_ID,
                'is_admin' => $tenant->is_admin,
                'password' => $tenant->password,
                'address' => $tenant->address,
            ];

            User::create($users);
        });
    }
}
