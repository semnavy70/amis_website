<?php

namespace Vanguard\Repositories\PageCategory;

interface PageCategoryRepository
{
    public function paginate($paginate, $search = null);

    public function store(array $data);

    public function single($id);

    public function update($id, $data);

    public function countById($id);

    public function delete($id);

    public function incrementOrder();
}
