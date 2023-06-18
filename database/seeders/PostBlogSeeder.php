<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanguard\PostBlog;

class PostBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostBlog::truncate();

        $list = [
            [
                "name" => "Normal",
                "slug" => "normal",
                "order" => 1,
            ],
            [
                "name" => "Top",
                "slug" => "top",
                "order" => 2,
            ],
            [
                "name" => "Middel",
                "slug" => "middle",
                "order" => 3,
            ],
        ];

        foreach ($list as $item) {
            $postBlog = new PostBlog();
            $postBlog->name = $item['name'];
            $postBlog->slug = $item['slug'];
            $postBlog->order = $item['order'];
            $postBlog->save();
        }

        dd("Success seed post blog");
    }
}
