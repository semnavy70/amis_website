<?php

namespace Vanguard\Support\Query;

use Vanguard\Advertise;
use Vanguard\Support\Enum\AdvertiseStatusEnum;

class AdvertiseQueryBuilder
{
    static public function getAdvertise($page, $blog)
    {
        return Advertise::where([
            'page' => $page,
            'blog' => $blog,
            'is_active' => AdvertiseStatusEnum::ACTIVE,
        ])
            ->orderBy('order')
            ->get();
    }

    static public function getAdvertiseByPage($page)
    {
        return Advertise::where([
            'page' => $page,
            'is_active' => AdvertiseStatusEnum::ACTIVE,
        ])
            ->orderBy('order')
            ->get();
    }

}
