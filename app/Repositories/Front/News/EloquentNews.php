<?php

namespace Vanguard\Repositories\Front\News;

use Illuminate\Support\Facades\DB;
use Vanguard\Support\Enum\PostStatusEnum;

class EloquentNews implements NewsRepository
{

    public function paginate($search = null)
    {
        $paginate = DB::table('posts as p')
            ->leftJoin('users as u', 'p.by', '=', 'u.id')
            ->leftJoin('post_statuses as ps', 'ps.slug', '=', 'p.status')
            ->where('p.status', '=', PostStatusEnum::PUBLISHED)
            ->when($search, function ($q) use ($search) {
                $q->where('p.title', "LIKE", "%" . $search . "%")
                    ->orWhere('p.slug', "LIKE", "%" . $search . "%")
                    ->orWhere('p.status', "LIKE", "%" . $search . "%")
                    ->orWhere('p.blog', "LIKE", "%" . $search . "%")
                    ->orWhere('p.body', "LIKE", "%" . $search . "%")
                    ->orWhere('p.excerpt', "LIKE", "%" . $search . "%")
                    ->orWhere('p.meta_keywords', "LIKE", "%" . $search . "%")
                    ->orWhere('p.source', "LIKE", "%" . $search . "%")
                    ->orWhere('u.first_name', "LIKE", "%" . $search . "%")
                    ->orWhere('u.last_name', "LIKE", "%" . $search . "%");
            })
            ->select([
                'p.id as id',
                'p.title as title',
                'p.excerpt as excerpt',
                'p.image as image',
                "u.last_name as by",
                DB::raw("DATE_FORMAT(CONVERT_TZ(p.created_at, '+00:00', '+07:00'), 'ថ្ងៃ %W ទី %d ខែ %M ឆ្នាំ %Y') as kh_created_at")
            ])
            ->orderBy('p.created_at', 'desc')
            ->paginate(6);
        foreach ($paginate as $post) {
            $post->kh_created_at = khmerFullDate($post->kh_created_at);
        }

        return $paginate;
    }

    public function detail(int $id)
    {
        $post = DB::table('posts as p')
            ->leftJoin('users as u', 'p.by', '=', 'u.id')
            ->leftJoin('post_statuses as ps', 'ps.slug', '=', 'p.status')
            ->where('p.status', '=', PostStatusEnum::PUBLISHED)
            ->where('p.id', $id)
            ->select([
                'p.id as id',
                'p.title as title',
                'p.body as body',
                'p.excerpt as excerpt',
                'p.image as image',
                "u.last_name as by",
                'p.category_id as category_id',
                DB::raw("DATE_FORMAT(CONVERT_TZ(p.created_at, '+00:00', '+07:00'), 'ថ្ងៃ %W ទី %d ខែ %M ឆ្នាំ %Y') as kh_created_at")
            ])
            ->first();
        if (!$post) {
            abort(404);
        }

        $post->kh_created_at = khmerFullDate($post->kh_created_at);

        return $post;
    }

    public function related($post)
    {
        $list = DB::table('posts as p')
            ->leftJoin('post_statuses as ps', 'ps.slug', '=', 'p.status')
            ->where('p.status', '=', PostStatusEnum::PUBLISHED)
            ->select([
                'p.id as id',
                'p.title as title',
            ])
            ->where('p.id', '!=', $post->id)
            ->where('p.category_id', '=', $post->category_id)
            ->orderBy('p.created_at', 'desc')
            ->limit(6)
            ->get();

        return $list;
    }

}

