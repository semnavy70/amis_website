<?php

namespace Vanguard\Repositories\Front\Library;

interface LibraryRepository
{
    public function detail($slug);

    public function documents($categoryId);

    public function categories($categoryId);
}
