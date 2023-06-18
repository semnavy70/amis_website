<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanguard\PostCategory;
use Vanguard\TranferLog;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'categories';
        $lastId = DB::table('tranfer_logs')
                ->where('name', $tableName)
                ->max('last_id') ?? 0;

        $oldPostCategories = DB::connection('mysql2')->table($tableName)
            ->select('*')
            ->where('id', '>', $lastId)
            ->limit(500)
            ->get();

        $newLastId = $lastId;
        foreach ($oldPostCategories as $postCategory) {
            $newPostCategory = new PostCategory();
            $newPostCategory->id = $postCategory->id;
            $newPostCategory->category_id = $postCategory->parent_id;
            $newPostCategory->name = $postCategory->name;
            $newPostCategory->slug = $postCategory->slug;
            $newPostCategory->order = $postCategory->order;
            $newPostCategory->created_at = $postCategory->created_at;
            $newPostCategory->updated_at = $postCategory->updated_at;
            $newPostCategory->save();
            $newLastId = $postCategory->id;
        }

        if ($newLastId == $lastId) {
            dd("no more record to transfer");
        } else {
            $log = new TranferLog();
            $log->name = $tableName;
            $log->last_id = $newLastId;
            $log->save();

            dd($log->toArray());
        }
    }
}
