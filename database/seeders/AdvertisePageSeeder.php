<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanguard\AdvertisePage;
use Vanguard\TranferLog;

class AdvertisePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'blog_ads';
        $lastId = DB::table('tranfer_logs')
                ->where('name', $tableName)
                ->max('last_id') ?? 0;

        $oldAdsBlog = DB::connection('mysql2')->table($tableName)
            ->select('*')
            ->where('id', '>', $lastId)
            ->limit(500)
            ->get();

        $newLastId = $lastId;
        foreach ($oldAdsBlog as $adsBlog) {
            $newAdsPage = new AdvertisePage();
            $newAdsPage->id = $adsBlog->id;
            $slug = "home";
            if ($adsBlog->id == 2) {
                $slug = "category";
            }
            if ($adsBlog->id == 3) {
                $slug = "detail";
            }
            $newAdsPage->slug = $slug;
            $newAdsPage->name = $adsBlog->name;
            $newAdsPage->created_at = $adsBlog->created_at;
            $newAdsPage->updated_at = $adsBlog->updated_at;
            $newAdsPage->save();
            $newLastId = $adsBlog->id;
        }


        if ($newLastId == $lastId) {
            dd("no more record to transfer");
        } else {
            $newAdsPage = new AdvertisePage();
            $newAdsPage->slug = "popup";
            $newAdsPage->name = "Popup";
            $newAdsPage->save();

            $log = new TranferLog();
            $log->name = $tableName;
            $log->last_id = $newLastId;
            $log->save();

            dd($log->toArray());
        }
    }
}
