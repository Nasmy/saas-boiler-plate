<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($user_id);
    public function getUserByRole($role_id);
    public function getUserByParams($arrParams);
    public function create($user);
    public function createOrUpdate($id = null, $collection = []);
    public function deleteUser($id);
    public function updateUser($id,$request);
    public function search($params);
}
