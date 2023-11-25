<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function listUser() {
        return $this->userRepository->getAllUsers();
    }

    public function listUserById($id) {
        return $this->userRepository->getUserById();
    }

    public function deleteUser($id) {
        return $this->userRepository->deleteUser($id, true);
    }

    public function createUser($data) {
        return $this->userRepository->createOrUpdate(null, $data);
    }

    public function updateUser($id, $data) {

        return $this->userRepository->createOrUpdate($id, $data);

    }

    public static function hashPassword($password): string
    {
        return Hash::make($password);
    }

}
