<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanguard\Advertise;
use Vanguard\TranferLog;

class AdvertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'advertises';
        $lastId = DB::table('tranfer_logs')
                ->where('name', $tableName)
                ->max('last_id') ?? 0;

        $oldAds = DB::connection('mysql2')->table($tableName)
            ->select('*')
            ->where('id', '>', $lastId)
            ->limit(500)
            ->get();

        $newLastId = $lastId;
        foreach ($oldAds as $ads) {
            $newAds = new Advertise();
            $newAds->id = $ads->id;

            $page = "home";
            if ($ads->blog_ads_id == 2) {
                $page = "category";
            }
            if ($ads->blog_ads_id == 3) {
                $page = "detail";
            }
            if ($ads->cat_ads_id == 5) {
                $page = "popup";
            }

            $newAds->page = $page;
            $newAds->blog_no = $ads->blog_number;

            $newAds->name = $ads->name;
            $newAds->image = $ads->image;
            $newAds->image_mobile = $ads->mobile_image;
            $newAds->image_tablet = $ads->ipad_image;
            $newAds->order = $ads->order ?? 0;
            $newAds->link = $ads->link;
            $newAds->created_at = $ads->created_at;
            $newAds->updated_at = $ads->updated_at;
            $newAds->save();
            $newLastId = $ads->id;
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
