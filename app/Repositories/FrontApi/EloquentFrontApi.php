<?php

namespace Vanguard\Repositories\FrontApi;

use Vanguard\Video;

class EloquentFrontApi implements FrontApiRepository
{

    public function video()
    {
        $paginate = Video::orderBy('published_at', 'desc')->paginate(12);

        return $paginate->toArray();
    }

}
