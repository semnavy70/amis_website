<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanguard\TranferLog;

class AdvertiseLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'loggings';
        $lastId = DB::table('tranfer_logs')
                ->where('name', $tableName)
                ->max('last_id') ?? 0;

        $oldAdsLog = DB::connection('mysql2')->table($tableName)
            ->select('*')
            ->where('id', '>', $lastId)
            ->limit(5000)
            ->get();

        DB::table('advertise_logs')->where('id', '>', $lastId)->delete();


        $payload = [];

        $newLastId = $lastId;
        foreach ($oldAdsLog as $adsLog) {
            $payload[] = [
                'id' => $adsLog->id,
                'advertise_id' => $adsLog->advertise_id,
                'user_agent' => $adsLog->user_agent,
                'page_url' => $adsLog->page_url,
                'ip' => $adsLog->ip,
                'created_at' => $adsLog->date,
                'updated_at' => $adsLog->date
            ];

            $newLastId = $adsLog->id;
        }

        DB::table('advertise_logs')->insert($payload);

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
