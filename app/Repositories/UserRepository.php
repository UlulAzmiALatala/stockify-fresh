<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAllUsers()
    {
        return User::latest()->paginate(10);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function findUserById(int $id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }
}
