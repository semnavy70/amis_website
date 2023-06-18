<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanguard\Menu;
use Vanguard\TranferLog;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'menus';
        $lastId = DB::table('tranfer_logs')
                ->where('name', $tableName)
                ->max('last_id') ?? 0;

        $oldMenu = DB::connection('mysql2')->table($tableName)
            ->select('*')
            ->where('id', '>', $lastId)
            ->limit(500)
            ->get();

        $newLastId = $lastId;
        foreach ($oldMenu as $menu) {
            $newMenu = new Menu();
            $newMenu->id = $menu->id;
            $newMenu->name = $menu->name;
            $newMenu->created_at = $menu->created_at;
            $newMenu->updated_at = $menu->updated_at;
            $newMenu->save();
            $newLastId = $menu->id;
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
