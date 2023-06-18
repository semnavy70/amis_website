<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanguard\PostStatus;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostStatus::truncate();

        $list = [
            [
                "name" => "Published",
                "slug" => "published",
                "order" => 1,
            ],
            [
                "name" => "Draft",
                "slug" => "draft",
                "order" => 2,
            ],
            [
                "name" => "Pending",
                "slug" => "pending",
                "order" => 3,
            ],
        ];

        foreach ($list as $item) {
            $postStatus = new PostStatus();
            $postStatus->name = $item['name'];
            $postStatus->slug = $item['slug'];
            $postStatus->order = $item['order'];
            $postStatus->save();
        }

        dd("Success seed post status");
    }
}
