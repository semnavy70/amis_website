<?php

namespace Vanguard\Repositories\Slide;

interface SlideRepository
{
    public function paginate($paginate, $search = null);

    public function store(array $data);

    public function single($id);

    public function update($id, $data);

    public function delete($id);

}
