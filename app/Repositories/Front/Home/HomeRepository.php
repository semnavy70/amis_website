<?php

namespace Vanguard\Repositories\Front\Home;

interface HomeRepository
{
    public function latestProduct();


    public function monthly($dataseriesCode, $cultureId);

    public function averagePrice();

    public function categories();

    public function commodities($categoryCode);

    public function latestProductExport();

    public function monthlyExport($dataseriesCode, $cultureId);
}
