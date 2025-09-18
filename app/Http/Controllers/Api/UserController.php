<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = $this->userService->createUser($data);
        return new UserResource($user);
    }

    public function show(string $id)
    {
        $user = $this->userService->findUserById($id);
        return new UserResource($user);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'sometimes|required|string|exists:roles,name',
        ]);

        $user = $this->userService->updateUser($id, $data);
        return new UserResource($user);
    }

    public function destroy(string $id)
    {
        $this->userService->deleteUser($id);
        return response()->json(['message' => 'User berhasil dihapus']);
    }
}
