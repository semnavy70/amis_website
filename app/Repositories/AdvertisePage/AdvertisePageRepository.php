<?php

namespace Vanguard\Repositories\AdvertisePage;

interface AdvertisePageRepository
{
    public function paginate($paginate, $search = null);

    public function store(array $data);

    public function single($id);

    public function update($id, $data);

    public function countBySlug($slug);

    public function delete($id);

    public function incrementOrder();
}
