<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanguard\TranferLog;
use Vanguard\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'videos';
        $lastId = DB::table('tranfer_logs')
                ->where('name', $tableName)
                ->max('last_id') ?? 0;

        $oldVideo = DB::connection('mysql2')->table($tableName)
            ->select('*')
            ->where('id', '>', $lastId)
            ->limit(500)
            ->get();

        $newLastId = $lastId;
        foreach ($oldVideo as $video) {
            $newVideo = new Video();
            $newVideo->id = $video->id;
            $newVideo->title = $video->title;
            $newVideo->slug = $video->slug;
            $newVideo->video_link = $video->video_link;
            $newVideo->image = $video->image;
            $newVideo->author = $video->author;
            $newVideo->created_at = $video->created_at;
            $newVideo->updated_at = $video->updated_at;
            $newVideo->save();
            $newLastId = $video->id;
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
