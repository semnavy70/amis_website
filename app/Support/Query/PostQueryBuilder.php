<?php

namespace Vanguard\Support\Query;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Vanguard\Support\Enum\PostStatusEnum;

class PostQueryBuilder
{
    static function getPost(): Builder
    {
        return DB::table('posts as p')
            ->leftJoin('post_categories as pc', 'pc.id', '=', 'p.category_id')
            ->leftJoin('users as u', 'u.id', '=', 'p.by')
            ->select(
                'p.*',
                "pc.name as name",
                "pc.slug as category_slug",
                "u.first_name as first_name",
                "u.last_name as last_name",
            )
            ->where(['p.status' => PostStatusEnum::PUBLISHED]);
    }

    static function getSingle(): Builder
    {
        return DB::table('posts as p')
            ->leftJoin('users as u', 'u.id', '=', 'p.by')
            ->select(
                'p.*',
                "u.first_name as first_name",
                "u.last_name as last_name",
            );
    }

    static function getPostRelate(): Builder
    {
        return DB::table('posts as p')
            ->leftJoin('post_categories as pc', 'pc.id', '=', 'p.category_id')
            ->select(
                'p.*',
                "pc.name as name",
                "pc.slug as category_slug"
            )
            ->where(['p.status' => PostStatusEnum::PUBLISHED]);
    }

    static function getPage(): Builder
    {
        return DB::table('pages as p')
            ->select('p.*')
            ->where(['p.status' => PostStatusEnum::PUBLISHED]);
    }

}
