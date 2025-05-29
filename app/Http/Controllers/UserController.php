<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BaseContract;
use App\Models\User;

class UserController extends Controller
{
    private UserService $userService;
    private $bearerToken;

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
#================================================================

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Buscar usuário pelo email e senha (texto puro)
        $user = User::where('email', $email)
                    ->where('password', $password)
                    ->first();        

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email ou senha inválidos.'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login realizado com sucesso.',
            'user' => $user,
            'token' => 'joaoToks',
        ]);
    }

}
