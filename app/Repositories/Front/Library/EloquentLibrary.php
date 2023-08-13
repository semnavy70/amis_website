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
            ->get();

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
