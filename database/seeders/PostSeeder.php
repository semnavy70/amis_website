<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanguard\Post;
use Vanguard\TranferLog;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'posts';
        $lastId = DB::table('tranfer_logs')
                ->where('name', $tableName)
                ->max('last_id') ?? 0;

        $oldPost = DB::connection('mysql2')->table($tableName)
            ->select('*')
            ->where('id', '>', $lastId)
            ->limit(1000)
            ->get();

        $newLastId = $lastId;
        DB::table('posts')
            ->where('id', ">", $lastId)
            ->delete();

        foreach ($oldPost as $post) {
            $newPost = new Post();
            $newPost->id = $post->id;
            $newPost->status = strtolower($post->status ?? "draft");
            $blog = "normal";
            if ($post->pin_to_top == "yes") {
                $blogPage = $post->blog_page_id;
                if ($blogPage == 1) {
                    $blog = "top";
                }
                if ($blogPage == 2) {
                    $blog = "middle";
                }
            }

            $newPost->blog = $blog;
            $newPost->category_id = $post->category_id;
            $newPost->by = 2;
            $newPost->source = $post->source;
            $newPost->title = $post->title;
            $newPost->slug = $post->slug;
            $newPost->body = $post->body;
            $newPost->image = $post->image;
            $newPost->image_tablet = $post->ipad_image;
            $newPost->image_mobile = $post->mobile_image;
            $newPost->image_thumbnail = $post->thumbnail_image;
            $newPost->image_top_news = $post->top_news_image;
            $newPost->view_count = $post->view_count ?? 0;
            $newPost->shared_count = $post->shared ?? 0;
            $newPost->like_count = $post->likecount ?? 0;
            $newPost->comment_count = $post->total_comment ?? 0;
            $newPost->seo_title = $post->seo_title ?? null;
            $newPost->excerpt = $post->excerpt ?? null;
            $newPost->meta_description = $post->meta_description ?? null;
            $newPost->meta_keywords = $post->meta_keywords ?? null;
            $newPost->created_at = $post->created_at;
            $newPost->updated_at = $post->updated_at;
            $newPost->save();
            $newLastId = $post->id;
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
