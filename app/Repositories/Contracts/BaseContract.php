<?php

namespace App\Repositories\Contracts;
interface BaseContract {
    public function create(array $datas);
    public function find(int $id);
    public function findAll();
    public function update(int $id, array $data);
    public function delete(int $id);
}
