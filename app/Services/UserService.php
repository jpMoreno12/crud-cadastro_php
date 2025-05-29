<?php

namespace App\Services;

use App\Repositories\Contracts\BaseContract;
use App\Repositories\UserRepository;

class UserService {
    private UserRepository $userRepository;

    public function __construct(BaseContract $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function createUser($data)
    {
        if (empty($data['email']) || empty($data['password']) || empty($data['name'])) {
            throw new \Exception('Parametro obrigatório!');
        }

        $user = $this->userRepository->create($data);

        return [
            'message' => 'Usuário criado com sucesso',
            'user' => $user,
        ];
    }
    
    public function listAllUsers() {
        $user = $this->userRepository->findAll();

        return [
            'message' => 'todos usuarios',
            'users' => $user,
        ];
    }

   public function searchUser(int $id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            throw new \Exception("Usuário não encontrado");
        }
        return [
            'user' => $user,
        ];
    }

    public function updateUser(int $id, $data)
    {
        if (empty($data['email']) || empty($data['password']) || empty($data['name'])) {
            throw new \Exception('Parametro obrigatório faltando!');
        }

        $user = $this->userRepository->update($id, $data);
        $user = $this->userRepository->find($id);
        return [
            'message' => 'Usuário atualizado com sucesso',
            'user' => $user,
        ];
    }

    public function deleteUser(int $id)
    {
        $deleted = $this->userRepository->delete($id);

        if (!$deleted) {
            throw new \Exception("Usuário não encontrado ou não pôde ser deletado");
        }

        return [
            'message' => 'Usuário deletado com sucesso',
        ];
    }
}
