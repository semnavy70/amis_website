<?php

namespace Vanguard\Repositories\PostStatus;

interface PostStatusRepository
{
    public function paginate(int $paginate, $search = null);

    public function store(array $data);

    public function single(int $id);

    public function update(int $id, array $data);

    public function countById($id);

    public function delete(int $id);

    public function incrementOrder();

}
