<?php

namespace Vanguard\Support\Traits;

use Carbon\Carbon;
use DB;

trait HomePageTrait
{
    protected function getLatestProductsUpdates($locale, $start, $limit, $maxAge): array
    {
        $baseSql = "
            FROM
            (
                SELECT
                comodity_code as comodity_code1,comodity_name as comodity_name1,comodity_name_en as comodity_name_en1,unit_code as u1, price as p1, mkt_date as d1
                FROM
                (
                  SELECT  @row_num := IF(@prev_value=o.comodity_code,@row_num+1,1) AS RowNumber
                        ,o.unit_code
                       ,o.comodity_code
                       ,o.comodity_name
                       ,o.comodity_name_en
                       ,o.value1 as price
                       ,o.mkt_date
                       ,@prev_value := o.comodity_code
                  FROM (
                    SELECT
                        unit_code,
                        data.comodity_code,
                        comodities.name_kh as comodity_name,
                        comodities.name_en as comodity_name_en,
                        avg(value1) as value1,
                        mkt_date
                    FROM data
                    INNER JOIN comodities
                    ON data.comodity_code = comodities.code
                    WHERE data.origin_code!='SMS' AND DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
                    GROUP BY unit_code,comodity_code,comodities.name_kh,comodities.name_en, YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
                  ) o,
                      (SELECT @row_num := 1) x,
                      (SELECT @prev_value := '') y
                  WHERE DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
                  ORDER BY o.comodity_code, o.mkt_date DESC
                ) a
                where RowNumber = 1
            ) q1

            LEFT JOIN

            (
                SELECT
                comodity_code as comodity_code2,comodity_name as comodity_name2,comodity_name_en as comodity_name_en2, unit_code as u2, price as p2, mkt_date as d2
                FROM
                (
                  SELECT  @row_num := IF(@prev_value=o.comodity_code,@row_num+1,1) AS RowNumber
                       ,o.unit_code
                       ,o.comodity_code
                       ,o.comodity_name
                       ,o.comodity_name_en
                       ,o.value1 as price
                       ,o.mkt_date
                       ,@prev_value := o.comodity_code
                  FROM (
                    SELECT
                        unit_code,
                        data.comodity_code,
                        comodities.name_kh as comodity_name,
                        comodities.name_en as comodity_name_en,
                        avg(value1) as value1,
                        mkt_date
                    FROM data
                    INNER JOIN comodities
                    ON data.comodity_code = comodities.code
                    WHERE data.origin_code!='SMS' AND DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
                    GROUP BY unit_code, comodity_code,comodities.name_kh,comodities.name_en, YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
                  ) o,
                      (SELECT @row_num := 1) x,
                      (SELECT @prev_value := '') y
                  WHERE DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
                  ORDER BY o.comodity_code, o.mkt_date DESC
                ) b
                where RowNumber = 2
            ) q2

            ON q1.comodity_code1 = q2.comodity_code2
            LEFT JOIN unites
            ON q1.u1 = unites.code
            ";

        if ($locale == 2) {
            $querySql = "
                SELECT
                    comodity_name1 as name,
                    u1 as unit,
                    p1 as latestPrice,
                    d1 as latestUpdate,
                    p2 as previousPrice,
                    d2 as previousUpdate

                $baseSql

                LIMIT $start, $limit
                ";
        } else {
            $querySql = "
                SELECT
                    comodity_name_en1 as name,
                    u1 as unit,
                    p1 as latestPrice,
                    d1 as latestUpdate,
                    p2 as previousPrice,
                    d2 as previousUpdate

                $baseSql

                LIMIT $start, $limit
                ";
        }

        $countSql = " SELECT count(*) as c $baseSql";
        $result = DB::connection('tmp')->select($querySql);
        $count = DB::connection('tmp')->select($countSql);
        $commodities = array();

        foreach ($result as $row) {
            $commodities[] = array(
                'name' => $this->textToUnicode($row->name),
                'unit' => $row->unit,
                'latestPrice' => $row->latestPrice,
                'latestUpdate' => $row->latestUpdate,
                'previousPrice' => $row->previousPrice,
                'previousUpdate' => $row->previousUpdate
            );
        }

        return array(
            $commodities,
            $count[0]->c
        );
    }

    public function getLatestProductsUpdatesExport($locale, $maxAge): array
    {
        $baseSql = "
            FROM
            (
                SELECT
                comodity_code as comodity_code1,comodity_name as comodity_name1,comodity_name_en as comodity_name_en1,unit_code as u1, price as p1, mkt_date as d1
                FROM
                (
                  SELECT  @row_num := IF(@prev_value=o.comodity_code,@row_num+1,1) AS RowNumber
                        ,o.unit_code
                       ,o.comodity_code
                       ,o.comodity_name
                       ,o.comodity_name_en
                       ,o.value1 as price
                       ,o.mkt_date
                       ,@prev_value := o.comodity_code
                  FROM (
                    SELECT
                        unit_code,
                        data.comodity_code,
                        comodities.name_kh as comodity_name,
                        comodities.name_en as comodity_name_en,
                        avg(value1) as value1,
                        mkt_date
                    FROM data
                    INNER JOIN comodities
                    ON data.comodity_code = comodities.code
                    WHERE data.origin_code!='SMS' AND DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
                    GROUP BY unit_code,comodity_code,comodities.name_kh,comodities.name_en, YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
                  ) o,
                      (SELECT @row_num := 1) x,
                      (SELECT @prev_value := '') y
                  WHERE DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
                  ORDER BY o.comodity_code, o.mkt_date DESC
                ) a
                where RowNumber = 1
            ) q1

            LEFT JOIN

            (
                SELECT
                comodity_code as comodity_code2,comodity_name as comodity_name2,comodity_name_en as comodity_name_en2, unit_code as u2, price as p2, mkt_date as d2
                FROM
                (
                  SELECT  @row_num := IF(@prev_value=o.comodity_code,@row_num+1,1) AS RowNumber
                       ,o.unit_code
                       ,o.comodity_code
                       ,o.comodity_name
                       ,o.comodity_name_en
                       ,o.value1 as price
                       ,o.mkt_date
                       ,@prev_value := o.comodity_code
                  FROM (
                    SELECT
                        unit_code,
                        data.comodity_code,
                        comodities.name_kh as comodity_name,
                        comodities.name_en as comodity_name_en,
                        avg(value1) as value1,
                        mkt_date
                    FROM data
                    INNER JOIN comodities
                    ON data.comodity_code = comodities.code
                    WHERE data.origin_code!='SMS' AND DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
                    GROUP BY unit_code, comodity_code,comodities.name_kh,comodities.name_en, YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
                  ) o,
                      (SELECT @row_num := 1) x,
                      (SELECT @prev_value := '') y
                  WHERE DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
                  ORDER BY o.comodity_code, o.mkt_date DESC
                ) b
                where RowNumber = 2
            ) q2

            ON q1.comodity_code1 = q2.comodity_code2
            LEFT JOIN unites
            ON q1.u1 = unites.code
            ";

        if ($locale == 2) {
            $querySql = "
                SELECT
                    comodity_name1 as name,
                    u1 as unit,
                    p1 as latestPrice,
                    d1 as latestUpdate,
                    p2 as previousPrice,
                    d2 as previousUpdate

                $baseSql
                ";
        } else {
            $querySql = "
                SELECT
                    comodity_name_en1 as name,
                    u1 as unit,
                    p1 as latestPrice,
                    d1 as latestUpdate,
                    p2 as previousPrice,
                    d2 as previousUpdate

                $baseSql
                ";
        }

        $countSql = "SELECT count(*) as c $baseSql";
        $result = DB::connection('tmp')->select($querySql);
        $count = DB::connection('tmp')->select($countSql);
        $commodities = array();
        foreach ($result as $row) {
            $commodities[] = array(
                'name' => $this->textToUnicode($row->name),
                'unit' => $row->unit,
                'latestPrice' => $row->latestPrice,
                'latestUpdate' => $row->latestUpdate,
                'previousPrice' => $row->previousPrice,
                'previousUpdate' => $row->previousUpdate
            );
        }

        return array(
            $commodities,
            $count[0]->c
        );
    }

    protected function find($commoditycode, $marketcode): array
    {
        $c = 0;
        $c1 = 0;
        $value = 0;
        $value1 = 0;
        $date = Carbon::now();
        $date->day = 1;
        $list = $_SESSION["alldata"];

        foreach ($list as $item) {
            if (($item->comodity_code == $commoditycode) && ($item->market_code == $marketcode)) {
                if ($date->diffInHours(Carbon::parse($item->mkt_date), false) > 0) {
                    if ($item->value1 > 0) {
                        $c++;
                        $value += floatval($item->value1);
                    }
                    if ($item->value2 > 0) {
                        $c++;
                        $value += floatval($item->value2);
                    }
                    if ($item->value3 > 0) {
                        $c++;
                        $value += floatval($item->value3);
                    }

                } else {
                    if ($item->value1 > 0) {
                        $c1++;
                        $value1 += floatval($item->value1);
                    }
                    if ($item->value2 > 0) {
                        $c1++;
                        $value1 += floatval($item->value2);
                    }
                    if ($item->value3 > 0) {
                        $c1++;
                        $value1 += floatval($item->value3);
                    }
                }
            }
        }

        $old = 0;
        $new = 0;
        if ($c != 0) {
            $new = $value / $c;
        }
        if ($c1 != 0) {
            $old = $value1 / $c1;
        }
        if ($c == 0 || $c1 == 0) {
            return array('diff' => 0, 'new' => $new, 'p' => 0);
        }

        return array('diff' => ($new - $old), 'new' => $new, 'p' => (($new - $old) / $old) * 100);
    }

    private function textToUnicode($text)
    {
        if (preg_match('/^\&\#/', trim($text))) {
            return html_entity_decode($text, ENT_NOQUOTES, 'UTF-8');
        }

        return $text;
    }

}
