<?php

namespace Vanguard\Repositories\Front\Home;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Vanguard\Support\Traits\HomePageTrait;

class EloquentHome implements HomeRepository
{

    use HomePageTrait;

    public function latestProduct(): \Illuminate\Support\Collection
    {
        $limit = 12;
        $maxAge = 100;
        $start = 1;

        $querySql = "
    WITH cte AS (
        SELECT
            o.comodity_code,
            o.comodity_name,
            o.comodity_name_en,
            o.unit_code,
            o.value1 AS price,
            o.mkt_date,
            ROW_NUMBER() OVER (PARTITION BY o.comodity_code ORDER BY o.mkt_date DESC) AS RowNumber
        FROM (
            SELECT
                unit_code,
                data.comodity_code,
                data.dataseries_code,
                comodities.name_kh AS comodity_name,
                comodities.name_en AS comodity_name_en,
                AVG(value1) AS value1,
                mkt_date
            FROM data
            INNER JOIN comodities ON data.comodity_code = comodities.code
            WHERE data.origin_code != 'SMS' AND DATE(mkt_date) >= DATE(DATE_SUB(NOW(), INTERVAL $maxAge DAY)) AND data.dataseries_code = 'WP'
            GROUP BY unit_code, comodity_code, comodities.name_kh, comodities.name_en, YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
        ) o
    )

    SELECT
        q1.comodity_name AS name,
        q1.unit_code AS unit,
        q1.price AS latest_price,
        q1.mkt_date AS latest_update,
        q2.price AS previous_price,
        q2.mkt_date AS previous_update
    FROM cte q1
    LEFT JOIN cte q2 ON q1.comodity_code = q2.comodity_code
    LEFT JOIN unites ON q1.unit_code = unites.code
    WHERE q1.RowNumber = 1 AND (q2.RowNumber = 2 OR q2.RowNumber IS NULL)
    LIMIT $start, $limit
";

        return collect(DB::connection('tmp')
            ->select($querySql))
            ->map(function ($item) {
                $status = "";
                if ($item->latest_price > $item->previous_price) {
                    $status = "OVER";
                } elseif ($item->latest_price < $item->previous_price) {
                    $status = "UNDER";
                }
                $item->latest_update = date_format(date_create($item->latest_update), 'd/m/Y');
                $item->latest_price = number_format($item->latest_price, 2) . " KHR";

                return [
                    'name' => $item->name,
                    'date' => $item->latest_update,
                    'price' => $item->latest_price . "/" . $item->unit,
                    'status' => $status,
                ];
            });
    }

    public function monthly($dataseriescode, $cultureid)
    {
        $startdate = Carbon::now()->subMonth();
        $startdate->day = 1;
        $enddate = Carbon::now();
        $commodities = DB::connection('tmp')
            ->table('comodities')
            ->where("dataserries_code", 1)
            ->get();
        $makets = DB::connection('tmp')
            ->table('data')
            ->where('mkt_date', '>=', $startdate)
            ->where('mkt_date', '<=', $enddate)
            ->where('dataseries_code', $dataseriescode)
            ->orderBy('market_code', 'ASC')
            ->orderBy('mkt_date', 'ASC')
            ->select('market_code')
            ->groupBy('market_code')
            ->get();
        $arr = $makets->pluck('market_code');

        $sample = Db::connection('tmp')
            ->table('data')
            ->whereIn('market_code', $arr)
            ->where('mkt_date', '>=', $startdate)
            ->where('mkt_date', '<=', $enddate)
            ->where('dataseries_code', $dataseriescode)
            ->where('origin_code', '!=', "SMS")
            ->get();
        session_start();
        $_SESSION['alldata'] = $sample;
        $list = array();
        foreach ($makets as $item) {
            $list1 = array();
            $test = false;
            foreach ($commodities as $item1) {
                $commodity = $this->find($item1->code, $item->market_code);
                $list1[] = array(
                    'name' => $cultureid == 2 ? $item1->name_kh : $item1->name_en,
                    'diff' => $commodity['diff'],
                    'new' => $commodity['new'],
                    'p' => $commodity['p']
                );
                if ($commodity['diff'] != 0) {
                    $test = true;
                }
            }
            if ($test) {
                $market = Db::connection('tmp')
                    ->table('markets')
                    ->where("code", $item->market_code)
                    ->first();
                $list[] = array(
                    "market" => $market,
                    "region" => Db::connection('tmp')->table('regions')->where("code", $market->region_code)->first(),
                    "commodity" => $list1
                );
            }
        }

        return $list;
    }

    public function price()
    {
        $locale = request()->get('locale');
        $commodityCode = request()->get('commodityCode');
        $commodityCode1 = request()->get('commodityCode1');
        $commodityCode2 = request()->get('commodityCode2');
        $dataseries = request()->get('dataseries');
        $maxAge = request()->get('maxAge');

        $sql = "
        SELECT data.comodity_code,comodities.name_en,comodities.name_kh,mkt_date,value1 as price,data.id as dataid
        FROM data
            LEFT JOIN comodities ON data.comodity_code = comodities.code
        WHERE data.comodity_code IN($commodityCode,$commodityCode1,$commodityCode2)
          AND data.dataseries_code = '$dataseries'
          AND data.origin_code!='SMS' AND data.value1>0
";

        if ($maxAge !== null) {
            $sql .= " AND mkt_date >= DATE_SUB(NOW(),INTERVAL $maxAge YEAR)";
        }

        $sql .= " GROUP BY YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)";
        $sql .= " ORDER BY mkt_date ASC";

        $result = DB::connection('tmp')->select($sql);
        $prices = array();
        foreach ($result as $row) {
            if (!isset($prices[$row->comodity_code])) {
                $prices[$row->comodity_code] = array(
                    'code' => $row->comodity_code,
                    'name' => $this->textToUnicode($locale == 2 ? $row->name_kh : $row->name_en),
                    'prices' => array()
                );
            }
            $prices[$row->comodity_code]['prices'][] = array(
                'date' => $row->mkt_date,
                'price' => $row->price,
                'id' => $row->dataid,
            );
        }

        return array_values($prices);
    }

    public function categories(): \Illuminate\Support\Collection
    {
        $lang = request()->get("language") ?? 1;
        $name = $lang == 1 ? "name_kh" : "name_en";
        return DB::connection('tmp')
            ->table("categories as c")
            ->orderBy("order")
            ->select("id", DB::raw("TRIM(code) as code"), $name . " as name", "is_default")
            ->get();
    }

    public function commodities($categoryCode): \Illuminate\Support\Collection
    {
        $lang = request()->get("language") ?? 1;
        $name = $lang == 1 ? "name_kh" : "name_en";
        return DB::connection('tmp')
            ->table("comodities as c")
            ->where("category_code", $categoryCode)
            ->orderBy("order")
            ->select("id", DB::raw("TRIM(code) as code"), $name . " as name", "is_default")
            ->get();
    }

}
