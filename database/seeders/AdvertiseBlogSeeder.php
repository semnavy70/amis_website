<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanguard\AdvertiseBlog;

class AdvertiseBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdvertiseBlog::truncate();
        foreach (range(1, 6) as $item) {
            $newAdsBlog = new AdvertiseBlog();
            $newAdsBlog->no = $item;
            $newAdsBlog->save();
        }

        dd("Generate advertise blog success");
    }
}
