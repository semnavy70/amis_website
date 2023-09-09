<?php

namespace Vanguard\Repositories\Front\Page;

interface FrontPageRepository
{
    public function detail($slug);

    public function related($page);

}
