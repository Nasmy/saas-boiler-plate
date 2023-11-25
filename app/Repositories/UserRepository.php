<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($user_id)
    {
        return User::where(['id' => $user_id])->firstOrFail();
    }

    public function getUserByRole($role_id)
    {
        return User::where(['role_id' => $role_id])->get();
    }

    public function getUserByParams($arrParams)
    {
        return User::where($arrParams)->first();
    }

    public function create($user)
    {
        return User::create($user);
    }

    public function updateUser($id, $request)
    {
        $user = User::findOrFail($id);
        $user->organization = $request->organization;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->save();
        return $user;
    }

    public function createOrUpdate($id = null, $collection = [])
    {
        return User::updateOrCreate(['id' => $id], $collection);
    }

    public function deleteUser($id, $isTenant = false)
    {
        $user = User::find($id);
        $username = $user->username;
        if (!$isTenant) {
            Tenant::destroy($username);
        }
        $user->delete();
    }

    /**
     * @description search tenant user
     * @param $params
     * @return object
     */
    public function search($params): object
    {
        $query = User::query();
        $query->join('domains', 'domains.user_id', 'users.id');
        foreach ($params as $key => $value) {
            if ($value != '' && $key != '_token') {
                switch ($key) {
                    case 'role_id':
                        $query->where('role_id', $value);
                        break;
                    case 'domain':
                        $query->where('domains.domain', 'like', $value . '%');
                        break;
                    default:
                        $query->where($key, 'like', $value . '%');
                }
            }
        }
        return $query->paginate(env('PAGE_COUNT'));
    }
}
