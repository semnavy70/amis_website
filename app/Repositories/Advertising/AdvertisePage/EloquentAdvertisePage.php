<?php

namespace Vanguard\Repositories\Advertising\AdvertisePage;

use Vanguard\AdvertisePage;

class EloquentAdvertisePage implements AdvertisePageRepository
{
    public function lists()
    {
        $advertisePage = AdvertisePage::get();
        return $advertisePage;
    }
}
