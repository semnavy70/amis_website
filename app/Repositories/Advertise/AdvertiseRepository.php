<?php

namespace Vanguard\Repositories\Advertise;

interface AdvertiseRepository
{
    public function paginate($paginate, $search = null);

    public function store(array $data);

    public function single($id);

    public function update($id, $data);

    public function delete($id);

    public function incrementOrder();

    public function pages();

    public function blogs();

    public function count();
}
