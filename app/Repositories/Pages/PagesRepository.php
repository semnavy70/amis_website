<?php

namespace Vanguard\Repositories\Pages;

interface PagesRepository
{
    public function paginate(int $paginate, $search = null);

    public function store(array $data);

    public function single(int $id);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function statuses();

    public function categories();

    public function deleteMany(array $postIds);

    public function duplicate(int $oldPostId);

}
