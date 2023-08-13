<?php

namespace Vanguard\Repositories\Front\News;

interface NewsRepository
{
    public function paginate($search = null);

    public function detail(int $id);

    public function related($post);
}
