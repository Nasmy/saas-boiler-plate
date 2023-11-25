<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TenantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name'=> 'Admin',
            'mobile' => '+94774022427',
            'email' => 'nasmy@keeneye.solutions',
            'username'=>'superadmin',
            'country' => 'LK',
            'city' => 'Colombo',
            'zip' => '10350',
            'role_id' => 1,
            'is_admin' => 1,
            'password' => Hash::make('DHs6MXun$U}kG3@U'),
            'address' => '19/3 temple road attidiya',
        ]);
    }
}
