<?php

namespace Vanguard\Repositories\Front\Home;

use Illuminate\Support\Facades\DB;

class EloquentHome implements HomeRepository
{

    public function latestProduct()
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
                comodities.name_kh AS comodity_name,
                comodities.name_en AS comodity_name_en,
                AVG(value1) AS value1,
                mkt_date
            FROM data
            INNER JOIN comodities ON data.comodity_code = comodities.code
            WHERE data.origin_code != 'SMS' AND DATE(mkt_date) >= DATE(DATE_SUB(NOW(), INTERVAL $maxAge DAY))
            GROUP BY unit_code, comodity_code, comodities.name_kh, comodities.name_en, YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
        ) o
    )

    SELECT
        q1.comodity_name_en AS name,
        q1.unit_code AS unit,
        q1.price AS latestPrice,
        q1.mkt_date AS latestUpdate,
        q2.price AS previousPrice,
        q2.mkt_date AS previousUpdate
    FROM cte q1
    LEFT JOIN cte q2 ON q1.comodity_code = q2.comodity_code
    LEFT JOIN unites ON q1.unit_code = unites.code
    WHERE q1.RowNumber = 1 AND (q2.RowNumber = 2 OR q2.RowNumber IS NULL)
    LIMIT $start, $limit
";
        $result = DB::connection('tmp')->select($querySql);
        dd($result);
    }

    public function monthly($dataseriescode, $cultureid)
    {
        // TODO: Implement monthly() method.
    }

    public function price()
    {
        // TODO: Implement price() method.
    }

    public function categories()
    {
        // TODO: Implement categories() method.
    }

    public function commodities($categoryCode)
    {
        // TODO: Implement commodities() method.
    }

}
