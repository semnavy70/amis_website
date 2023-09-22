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
        $start = (request()->get('page') ?? 0) * $limit;

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


    public function averagePrice(): array
    {
        $commodityCode = request()->get('commodityCode');
        $dataseries = request()->get('dataseries');
        $startDate = request()->get('startDate');
        $endDate = request()->get('endDate');

        $sqlStatement = /** @lang text */
            "
        SELECT
            data.comodity_code,
            comodities.name_kh AS name,
            mkt_date AS date,
            value1 AS price,
            data.id AS dataid
        FROM data
        LEFT JOIN comodities ON data.comodity_code = comodities.code
        WHERE data.comodity_code = '$commodityCode'
            AND data.dataseries_code = '$dataseries'
            AND data.origin_code != 'SMS'
            AND data.value1 > 0
            AND mkt_date >= '$startDate'
            AND mkt_date <= '$endDate'
            GROUP BY YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
            ORDER BY mkt_date ASC
        ";
        $results = DB::connection('tmp')->select($sqlStatement);
        $prices = [];
        foreach ($results as $row) {
            $commodityCode = $row->comodity_code;
            if (!isset($prices[$commodityCode])) {
                $prices[$commodityCode] = [
                    'code' => $commodityCode,
                    'name' => $this->textToUnicode($row->name),
                    'prices' => [],
                ];
            }
            $prices[$commodityCode]['prices'][] = [
                'date' => $row->date,
                'price' => $row->price,
                'id' => $row->dataid,
            ];
        }

        return array_values($prices);
    }

    public function monthly($dataseriescode, $cultureId): array
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
        $maketCodes = $makets->pluck('market_code');
        $allData = Db::connection('tmp')
            ->table('data')
            ->whereIn('market_code', $maketCodes)
            ->where('mkt_date', '>=', $startdate)
            ->where('mkt_date', '<=', $enddate)
            ->where('dataseries_code', $dataseriescode)
            ->where('origin_code', '!=', "SMS")
            ->get();

        $list = [];
        foreach ($makets as $item) {
            $newList = [];
            $test = false;
            foreach ($commodities as $comodity) {
                $commodity = $this->findCommodity($comodity->code, $item->market_code, $allData);
                $newList[] = [
                    'name' => $cultureId == 2 ? $comodity->name_kh : $comodity->name_en,
                    'diff' => $commodity['diff'],
                    'new' => $commodity['new'],
                    'p' => $commodity['p'],
                ];
                if ($commodity['diff'] != 0) {
                    $test = true;
                }
            }
            if ($test) {
                $market = Db::connection('tmp')
                    ->table('markets')
                    ->where("code", $item->market_code)
                    ->first();
                $region = Db::connection('tmp')
                    ->table('regions')
                    ->where("code", $market->region_code)
                    ->first();
                $list[] = [
                    "market" => $market,
                    "region" => $region,
                    "commodity" => $newList,
                ];
            }
        }

        return $list;
    }

}
