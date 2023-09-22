<?php

namespace Vanguard\Repositories\Front\Home;

interface HomeRepository
{
    public function latestProduct();

    public function monthly($dataseriescode, $cultureId);

    public function averagePrice();

    public function categories();

    public function commodities($categoryCode);
}
