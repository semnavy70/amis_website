<?php

namespace Vanguard\Repositories\Front\Home;

interface HomeRepository
{
    public function latestProduct();

    public function monthly($dataseriescode, $cultureid);

    public function price();

    public function categories();

    public function commodities($categoryCode);
}
