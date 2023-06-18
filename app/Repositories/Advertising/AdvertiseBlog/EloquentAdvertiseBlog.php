<?php

namespace Vanguard\Repositories\Advertising\AdvertiseBlog;

use Vanguard\AdvertiseBlog;

class EloquentAdvertiseBlog implements AdvertiseBlogRepository
{

    public function lists()
    {
        $advertiseBlog = AdvertiseBlog::get();
        return $advertiseBlog;
    }
}
