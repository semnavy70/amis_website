<?php

namespace Vanguard\Repositories\Front\Library;

use Illuminate\Support\Facades\DB;

class EloquentLibrary implements LibraryRepository
{

    public function detail($slug)
    {
        $item = DB::table('document_categories')
            ->where('slug', '=', $slug)
            ->select([
                'id',
                'slug',
                'name',
                'description',
            ])
            ->first();


        return $item;
    }

    public function documents($categoryId)
    {
        $list = DB::table('documents')
            ->where('category_id', '=', $categoryId)
            ->select([
                'id',
                'title',
                'type',
                'source', DB::raw("DATE_FORMAT(CONVERT_TZ(created_at, '+00:00', '+07:00'), '%d %M %Y') as kh_created_at")
            ])
            ->get()
            ->map(function ($item) {
                $item->source = getFileCDN($item->source);
                $item->kh_created_at = khmerFullDate($item->kh_created_at);

                return $item;
            });

        return $list;
    }

    public function categories($categoryId)
    {
        $list = DB::table('document_categories')
            ->where('id', '!=', $categoryId)
            ->select([
                'id',
                'slug',
                'name',
            ])
            ->get();

        return $list;
    }
}
