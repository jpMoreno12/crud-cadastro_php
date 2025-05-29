<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BaseContract;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    
    public function index() {
        $users = $this->userService->listAllUsers();
        return response()->json($users);
    }

    public function show(int $id) {
        $user = $this->userService->searchUser($id);
        return response()->json($user);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string',
        'yearsOld' => 'required|integer',
        'password' => 'required|string',
    ]);

        $user = $this->userService->createUser($validatedData);
        return response()->json($user, 201);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'yearsOld' => 'required|integer',
            'password' => 'required|string',
        ]);

        $user = $this->userService->updateUser($id, $validatedData);

        return response()->json($user);
    }

    public function destroy(int $id)
    {
        $response = $this->userService->deleteUser($id);
        return response()->json($response);
    }
}
