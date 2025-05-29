<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseContract;
use App\Models\User;

class UserRepository implements BaseContract
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(array $data) {
        return $this->user->create($data);
    }
    public function find(int $id) {
        return $this->user->find($id);
    }
    public function findAll() {
        return $this->user->all();
    }
    public function update(int $id, array $data) {
        $user = $this->user->find($id);
        if($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }
    public function delete(int $id) {
        $user = $this->user->find($id);
        if($user) {
            return $user->delete();
        }
        return false;
    }
}
