<?php

namespace Vanguard\Repositories\Front\Page;

use Illuminate\Support\Facades\DB;
use Vanguard\Support\Enum\PostStatusEnum;

class EloquentFrontPage implements FrontPageRepository
{

    public function detail($slug)
    {
        $page = DB::table('pages as p')
            ->where('p.status', '=', PostStatusEnum::PUBLISHED)
            ->select([
                'p.id as id',
                'p.title as title',
                'p.excerpt as excerpt',
                'p.image as image',
                'p.body as body',
                'p.category_id as category_id',
            ])
            ->where('slug', '=', $slug)
            ->first();

        return $page;
    }

    public function related($page)
    {
        $list = DB::table('pages as p')
            ->where('p.status', '=', PostStatusEnum::PUBLISHED)
            ->where('p.category_id', $page->category_id)
            ->where('p.id', '!=', $page->id)
            ->select([
                'p.id as id',
                'p.title as title',
                'p.slug as slug',
            ])
            ->orderBy('title')
            ->get();

        return $list;
    }

}
