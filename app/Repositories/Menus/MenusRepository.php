<?php

namespace Vanguard\Repositories\Menus;

interface MenusRepository
{
    public function paginate(int $paginate, $search = null);

    public function store(array $data);

    public function single($id);

    public function update($id, $data);

    public function delete($id);
}
