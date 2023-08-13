<?php

namespace Vanguard\Repositories\Partner;

interface PartnerRepository
{
    public function paginate($paginate, $search = null);

    public function store(array $data);

    public function single($id);

    public function update($id, $data);

    public function delete($id);

}
