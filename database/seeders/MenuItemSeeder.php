<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Vanguard\MenuItem;
use Vanguard\TranferLog;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'menu_items';
        $lastId = DB::table('tranfer_logs')
                ->where('name', $tableName)
                ->max('last_id') ?? 0;

        $oldMenuItem = DB::connection('mysql2')->table($tableName)
            ->select('*')
            ->where('id', '>', $lastId)
            ->limit(500)
            ->get();

        $newLastId = $lastId;
        foreach ($oldMenuItem as $menuItem) {
            $newMenuItem = new MenuItem();
            $newMenuItem->id = $menuItem->id;
            $newMenuItem->menu_id = $menuItem->menu_id;
            $newMenuItem->parent_id = $menuItem->parent_id;
            $newMenuItem->title = $menuItem->title;
            $newMenuItem->url = $menuItem->url;
            $newMenuItem->icon_class = $menuItem->icon_class;
            $newMenuItem->color = $menuItem->color;
            $newMenuItem->target = $menuItem->target;
            $newMenuItem->order = $menuItem->order;
            $newMenuItem->route = $menuItem->route;
            $newMenuItem->parameters = $menuItem->parameters;
            $newMenuItem->created_at = $menuItem->created_at;
            $newMenuItem->updated_at = $menuItem->updated_at;
            $newMenuItem->save();
            $newLastId = $menuItem->id;
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
