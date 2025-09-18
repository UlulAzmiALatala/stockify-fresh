<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Spatie\Permission\Models\Role;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->userRepository->createUser($data);
        $role = Role::findByName($data['role'], 'web');
        $user->assignRole($role);

        return $user;
    }

    public function findUserById(int $id)
    {
        return $this->userRepository->findUserById($id);
    }

    public function updateUser(int $id, array $data)
    {
        $user = $this->userRepository->findUserById($id);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $updatedUser = $this->userRepository->updateUser($user, $data);

        if (!empty($data['role'])) {
            $role = Role::findByName($data['role'], 'web');
            $updatedUser->syncRoles($role);
        }

        return $updatedUser;
    }

    public function deleteUser(int $id)
    {
        $user = $this->userRepository->findUserById($id);
        $this->userRepository->deleteUser($user);
    }
}
