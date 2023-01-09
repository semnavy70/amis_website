<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Lang;

class MarketController extends Controller
{
    public function price()
    {
        $locale = $_GET['locale'];
        $commodityCode = $_GET['commodityCode'];
        $commodityCode1 = $_GET['commodityCode1'];
        $commodityCode2 = $_GET['commodityCode2'];
        $dataseries = $_GET['dataseries'];
        $maxAge = $_GET['maxAge'];

        $sql = "SELECT amisdata.commoditycode, name, date, value1 as price,dataid FROM amisdata LEFT JOIN amiscommoditylocale ON amisdata.commoditycode = amiscommoditylocale.commoditycode WHERE amisdata.commoditycode IN($commodityCode,$commodityCode1,$commodityCode2) AND amisdata.dataseriescode = '$dataseries' AND cultureid = $locale AND amisdata.datasourcecode!='SMS' AND amisdata.value1>0" ;
        //return $sql;
        //dd($sql);

        if ($maxAge !== null) {
            $sql .= " AND date >= DATE_SUB(NOW(),INTERVAL $maxAge YEAR)";
        }

        $sql .= " GROUP BY YEAR(date), MONTH(date), DAY(date)";
        $sql .= " ORDER BY date ASC";
        
        //echo $sql;
        //dd($sql);

        $result = DB::select($sql);
        $prices = array();
        foreach ($result as $row) {
            if (!isset($prices[$row->commoditycode])) {
                $prices[$row->commoditycode] = array(
                    'code' => $row->commoditycode,
                    'name' => $this->textToUnicode($row->name),
                    'prices' => array()
                );
            }
            $prices[$row->commoditycode]['prices'][] = array(
                'date' => $row->date,
                'price' => $row->price,
                'id'=>$row->dataid,
            );
        }

        $result = array_values($prices);
        return response($result,200)->json();
    }

    public function commodity()
    {
        if (! isset($_REQUEST['categoryCode'])) {
            return;
        }

        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
        $categoryCode = intval($_REQUEST['categoryCode']);

        $sql = "
            SELECT amiscommodity.commoditycode as commodityCode, name , amiscommodity.is_default
            FROM amiscommodity
            LEFT JOIN amiscommoditylocale
            ON amiscommodity.commoditycode = amiscommoditylocale.commoditycode
            WHERE cultureid = $locale
            AND is_exposed = TRUE
            AND categorycode = $categoryCode
                ";

        $result = DB::select($sql);
        $commodities = array();
        foreach ($result as $item){
            $is_default = false;
            if($item->is_default==1){
                $is_default = true;
            }
            $commodities[] = array(
                'commodityCode' => $item->commodityCode,
                'name' => $this->textToUnicode($item->name),
                'is_default'=>$is_default
            );
        }

        return response($commodities,200)->json();
    }

    public function commodities_cat()
    {
        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
        $sql = "
        SELECT cl.categorycode as categoryCode, cl.name ,cat.is_default
        FROM amiscategorylocale as cl
        LEFT JOIN  amiscategory as cat
        ON cat.categorycode = cl.categorycode
        WHERE cl.cultureid = $locale   AND  cl.categoryCode != '005'
            ";

        $result = DB::select($sql);
        //dd($result);
        $commodities = array();
        foreach ($result as $item){
            $is_default = 0;
            if($item->is_default==1){
                $is_default = true;
            }
            $commodities[] = array(
                'categoryCode' => $item->categoryCode,
                'name' => $this->textToUnicode($item->name),
                'is_default'=>$is_default
            );
        }

        return response($commodities,200)->json();

    }

    public function commodities_list()
    {
        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;

        $sql = "
            SELECT amiscommodity.commoditycode as commodityCode, name, smsparameter as smsCode
            FROM amiscommodity
            LEFT JOIN amiscommoditylocale
            ON amiscommodity.commoditycode = amiscommoditylocale.commoditycode
            LEFT JOIN smsparametermapping
            ON amiscommodity.commoditycode = smsparametermapping.amiscode
            WHERE cultureid = $locale
            AND is_exposed = TRUE
                ";

        $result = DB::select($sql);
        $commodities = array();
        foreach ($result as $item){

            $commodities[] = array(
                'commodityCode' => $item->commodityCode,
                'name' => $this->textToUnicode($item->name),
                'smsCode' => $item->smsCode
            );
        }

        return response($commodities,200)->json();
    }
    public function market_commodity()
    {

        if (!isset($_REQUEST['commodityCode'])) {
            return;
        }

        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
        $commodityCode = intval($_REQUEST['commodityCode']);

        $userTypes = array();
        if (isset($_REQUEST['userType'])) {
            foreach($_REQUEST['userType'] as $userType) {
                $userTypes[] = intval($userType);
            }
        }
        $sql = "
            SELECT amisdata.marketcode, usertypeid, name, date, AVG(value1) as price
            FROM amisdata
            LEFT JOIN amismarketlocale
            ON amisdata.marketcode = amismarketlocale.marketcode
            WHERE commoditycode = $commodityCode
            AND cultureid = $locale
            AND value1>0
                ";

        if (sizeof($userTypes) > 0) {
            $sql .= " AND usertypeid in ( " . join(',', $userTypes) . ")";
        }

        $sql .= " GROUP BY YEAR(date), MONTH(date), DAY(date)";


        //$markets = getCommodityPricePerMarketAndUserType($commodityCode, $userTypes, $locale);
        $result = DB::select($sql);
        $markets = array();
        foreach ($result as $row) {
            if (!isset($markets[$row->marketcode][$row->usertypeid])) {
                $markets[$row->marketcode][$row->usertypeid] = array(
                    'code' => $row->marketcode,
                    'userType' => $row->usertypeid,
                    'name' => $this->textToUnicode($row->name),
                    'prices' => array()
                );
            }
            $markets[$row->marketcode][$row->usertypeid]['prices'][] = array(
                'date' => $row->date,
                'price' => $row->price
            );
        }

        $result = array();
        foreach($markets as $market) {
            $result = array_merge($result, array_values($market));
        }

        return response($result,200)->json();
    }

    public function markets_list()
    {
        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;

        $sql = "
        SELECT amismarket.marketcode as marketCode, amismarketlocale.name as name,
        smsparameter as smsCode, amisregionlocale.name as regionName
        FROM amismarket
        LEFT JOIN amismarketlocale
        ON amismarket.marketcode = amismarketlocale.marketcode
        LEFT JOIN amisregionlocale
        ON amismarket.regioncode = amisregionlocale.regioncode
        LEFT JOIN smsparametermapping
        ON amismarket.marketcode = smsparametermapping.amiscode
        WHERE amismarketlocale.cultureid = $locale
        AND amisregionlocale.cultureid = $locale
            ";

        $result = DB::select($sql);
        $markets = array();
        foreach ($result as $item){
            $markets[] = array(
                'marketCode' => $item->marketCode,
                'name' => $this->textToUnicode($item->name),
                'smsCode' => $item->smsCode,
                'regionName' => $this->textToUnicode($item->regionName)
            );
        }

        return response($markets,200)->json();
    }
    public function province_commodity()
    {

        if (! isset($_REQUEST['commodityCode'])) {
            return;
        }

        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
        $commodityCode = intval($_REQUEST['commodityCode']);

        $userTypes = array();
        if (isset($_REQUEST['userType'])) {
            foreach($_REQUEST['userType'] as $userType) {
                $userTypes[] = intval($userType);
            }
        }


        $sql = "
            SELECT amisregionlocale.regioncode, usertypeid, name, date, AVG(value1) as price
            FROM amisdata
            LEFT JOIN amismarket
            ON amisdata.marketcode = amismarket.marketcode
            LEFT JOIN amisregionlocale
            ON amismarket.regioncode = amisregionlocale.regioncode
            WHERE commoditycode = $commodityCode
            AND cultureid = $locale
                ";

        if (sizeof($userTypes) > 0) {
            $sql .= " AND usertypeid in ( " . join(',', $userTypes) . ")";
        }

        $sql .= " GROUP BY YEAR(date), MONTH(date), DAY(date)";


        //$markets = getCommodityPricePerProvinceAndUserType($commodityCode, $userTypes, $locale);
        $result = DB::select($sql);
        $markets = array();
        foreach ($result as $row) {
            if (!isset($markets[$row->regioncode][$row->usertypeid])) {
                $markets[$row->regioncode][$row->usertypeid] = array(
                    'code' => $row->regioncode,
                    'userType' => $row->usertypeid,
                    'name' => $this->textToUnicode($row->name),
                    'prices' => array()
                );
            }
            $markets[$row->regioncode][$row->usertypeid]['prices'][] = array(
                'date' => $row->date,
                'price' => $row->price
            );
        }

        $result = array();
        foreach($markets as $market) {
            $result = array_merge($result, array_values($market));
        }

        return response($result,200)->json();
    }

    public function latest_product()
    {    
        $start_col1 = "";
        $start_col2 = "";
       // $locale = \App::getLocale();

        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
        $start = isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 0;
        $maxAge = isset($_REQUEST['maxAge']) ? intval($_REQUEST['maxAge']) : 100;
        $limit = 12;

        if ($locale == 1)
        {
            $start_col1 = '<div class="col-md-6 col-sm-12  col-xs-12"><table class="table table-striped" id="daily1"><thead><tr><th>Commodity Type</th><th style="text-align:center;">Date of Report</th><th style="text-align:right;">Price</th></tr></thead><body>';
            $start_col2 = '<div class="col-md-6 col-sm-12  col-xs-12"><table class="table table-striped" id="daily2"><thead><tr><th>Commodity Type</th><th style="text-align:center;">Date of Report</th><th style="text-align:right;">Price</th></tr></thead><body>';
        }
        else
        {
            $start_col1 = '<div class="col-md-6 col-sm-12  col-xs-12"><table class="table table-striped" id="daily1"><thead><tr><th>ប្រភេទទំនិញ</th><th style="text-align:center;">កាលបរិច្ឆេទនៃរបាយការណ៍</th><th style="text-align:right;">តម្លៃ</th></tr></thead><body>';
            $start_col2 = '<div class="col-md-6 col-sm-12  col-xs-12"><table class="table table-striped" id="daily2"><thead><tr><th>ប្រភេទទំនិញ</th><th style="text-align:center;">កាលបរិច្ឆេទនៃរបាយការណ៍</th><th style="text-align:right;">តម្លៃ</th></tr></thead><body>';
        }

        $commodities = $this->getLatestProductsUpdates($locale, $start, $limit, $maxAge);
        //dd($commodities);

        $nextStart = $start + $limit;
        $linkClass = "float-right";
        $linkLabel = 'Next <i class="fas fa-angle-double-right"></i>';

        if ($start === 0 && $commodities[1] <= $limit) {
            $linkClass = "hidden";
        } else {
            if ( $start + $limit >= $commodities[1] ) {
                $nextStart = $start - $limit;
                $linkClass = "float-left";
                $linkLabel = '<i class="fas fa-angle-double-left"></i> Prev';
            }
        }
        $row1 ="";
        $row2 ="";
        $i=0;
        foreach($commodities[0] as $commodity) {
            $class = 'fa-sort-up';
            $style = 'color:green;';

            if( $commodity['previousPrice'] > $commodity['latestPrice'] ) {
                $class = 'fa-sort-down';
                $style = 'color:red;';
            }
            if(($i%2)==1){
                $row1 = $row1 . "<tr><td>".$commodity['name']."</td><td style='text-align:center;'>".date_format(date_create($commodity['latestUpdate']), 'd/m/Y')."</td><td style='text-align:right;'>".number_format($commodity['latestPrice'],2)." KHR/".$commodity['unit']." <span class='fa ".$class."' style='".$style."'></span></td></tr>";
            }else{
                $row2 = $row2 . "<tr><td>".$commodity['name']."</td><td style='text-align:center;'>".date_format(date_create($commodity['latestUpdate']), 'd/m/Y')."</td><td style='text-align:right;'>".number_format($commodity['latestPrice'],2)." KHR/".$commodity['unit']." <span class='fa ".$class."' style='".$style."'></span></td></tr>";
            }
            $i++;

        }
        $end_col1 = "</body></table></div>";
        $end_col2 = "</body></table></div>";
        $a = "<div class='col-md-12'><a href='#' data-start='".$nextStart."' data-limit='".$limit."' class='".$linkClass."' style='color: #707A1A;text-decoration: none;' onclick='LatestProductLoader.load(); return false;' id='LatestProductMore'>".$linkLabel."</a></div>";
        return "<div class='row'>".$start_col1.$row1.$end_col1.$start_col2.$row2.$end_col2.$a."</div>";

    }
    public function latest_product_export()
    {
        $start_col1 = "";
        // $locale = \App::getLocale();

        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
        $start = isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 0;
        $maxAge = isset($_REQUEST['maxAge']) ? intval($_REQUEST['maxAge']) : 100;

        $limit = 12;

        if ($locale == 1)
        {
            $start_col1 = '<thead><tr><th>Commodity Type</th><th style="text-align:center;">Date of Report</th><th style="text-align:right;">Price</th></tr></thead><tbody>';

        }
        else
        {
            $start_col1 = '<thead><tr><th>ប្រភេទទំនិញ</th><th style="text-align:center;">កាលបរិច្ឆេទនៃរបាយការណ៍</th><th style="text-align:right;">តម្លៃ</th></tr></thead><tbody>';

        }

        $commodities = $this->getLatestProductsUpdatesExport($locale, $maxAge);
        //return $commodities;
        //dd($commodities[1]);

        $nextStart = $start + $limit;
        $linkClass = "float-right";

        if ($start === 0 && $commodities[1] <= $limit) {
            $linkClass = "hidden";
        } else {
            if ( $start + $limit >= $commodities[1] ) {
                $nextStart = $start - $limit;
                $linkClass = "float-left";
            }
        }
        $row1 ="";
        $i=0;
        foreach($commodities[0] as $commodity) {
            $class = 'fa-sort-up';
            $style = 'color:green;';

            if( $commodity['previousPrice'] > $commodity['latestPrice'] ) {
                $class = 'fa-sort-down';
                $style = 'color:red;';
            }
            $row1 = $row1 . "<tr><td>".$commodity['name']."</td><td style='text-align:center;'>".date_format(date_create($commodity['latestUpdate']), 'd/m/Y')."</td><td style='text-align:right;'>".number_format($commodity['latestPrice'],2)." KHR/".$commodity['unit']." <span class='fa ".$class."' style='".$style."'></span></td></tr>";
            $i++;

        }
        $end_col1 = "</tbody>";

         return $start_col1.$row1.$end_col1;

    }
    public function getLatestProductsUpdates($locale, $start, $limit, $maxAge)
    {
        $baseSql = "
        FROM 
        (
            SELECT
            commoditycode, unitcode, price as p1, date as d1
            FROM
            (
              SELECT  @row_num := IF(@prev_value=o.commoditycode,@row_num+1,1) AS RowNumber
                    ,o.unitcode
                   ,o.commoditycode
                   ,o.value1 as price
                   ,o.date
                   ,@prev_value := o.commoditycode
              FROM (
                SELECT
                    unitcode, 
                    amiscurrentdata.commoditycode,
                    avg(value1) as value1,
                    date
                FROM amiscurrentdata
                INNER JOIN amiscommodity
                ON amiscurrentdata.commoditycode = amiscommodity.commoditycode
                WHERE is_exposed = TRUE AND amiscurrentdata.datasourcecode='SMS'
                GROUP BY unitcode,commoditycode,YEAR(date),MONTH(date), DAY(date)
              ) o,
                  (SELECT @row_num := 1) x,
                  (SELECT @prev_value := '') y
              WHERE DATE(date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
              ORDER BY o.date ASC
            ) a
            where RowNumber = 1
        ) q1
        
        LEFT JOIN
        
        (
            SELECT
            commoditycode, unitcode, price as p2, date as d2
            FROM
            (
              SELECT  @row_num := IF(@prev_value=o.commoditycode,@row_num+1,1) AS RowNumber
                    ,o.unitcode
                   ,o.commoditycode
                   ,o.value1 as price
                   ,o.date
                   ,@prev_value := o.commoditycode
              FROM (
                SELECT
                    unitcode, 
                    amiscurrentdata.commoditycode,
                    avg(value1) as value1,
                    date
                FROM amiscurrentdata
                INNER JOIN amiscommodity
                ON amiscurrentdata.commoditycode = amiscommodity.commoditycode
                WHERE is_exposed = TRUE AND amiscurrentdata.datasourcecode='SMS'
                GROUP BY unitcode, commoditycode, YEAR(date), MONTH(date), DAY(date)
              ) o,
                  (SELECT @row_num := 1) x,
                  (SELECT @prev_value := '') y
              WHERE DATE(date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
              ORDER BY o.date DESC
            ) b
            where RowNumber = 2
        ) q2
        
        ON q1.commoditycode = q2.commoditycode
        
        LEFT JOIN amiscommoditylocale 
        ON q1.commoditycode = amiscommoditylocale.commoditycode 
        LEFT JOIN amisunitlocale 
        ON q1.unitcode = amisunitlocale.unitcode 
        
        WHERE 
        amiscommoditylocale.cultureid = $locale
        AND
        amisunitlocale.cultureid = $locale
        ";

        $querySql = "
        SELECT 
            amiscommoditylocale.name as name,
            amisunitlocale.shortname as unit,
            p1 as latestPrice,
            d1 as latestUpdate,
            p2 as previousPrice,
            d2 as previousUpdate
    
        $baseSql
    
        LIMIT $start, $limit
        ";

            $countSql = "
        SELECT count(*) as c
        $baseSql
        ";
        $result =  DB::select($querySql);
        $count = DB::select($countSql);
        $commodities = array();
        //$arr = explode(":",$count[0]."");
        //dd($count[0]->c);
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
        return response(array(
            $commodities,
            $count[0]->c
        ),200)->json();


    }

    public function getLatestProductsUpdatesExport($locale, $maxAge)
    {
        $baseSql = "
        FROM
        
        (
            SELECT
            commoditycode, unitcode, price as p1, date as d1
            FROM
            (
              SELECT  @row_num := IF(@prev_value=o.commoditycode,@row_num+1,1) AS RowNumber
                    ,o.unitcode
                   ,o.commoditycode
                   ,o.value1 as price
                   ,o.date
                   ,@prev_value := o.commoditycode
              FROM (
                SELECT
                    unitcode, 
                    amiscurrentdata.commoditycode,
                    avg(value1) as value1,
                    date
                FROM amiscurrentdata
                INNER JOIN amiscommodity
                ON amiscurrentdata.commoditycode = amiscommodity.commoditycode
                WHERE is_exposed = TRUE  AND amiscurrentdata.datasourcecode='SMS'
                GROUP BY unitcode, commoditycode, YEAR(date), MONTH(date), DAY(date)
              ) o,
                  (SELECT @row_num := 1) x,
                  (SELECT @prev_value := '') y
              WHERE DATE(date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
              ORDER BY  o.date  ASC
            ) a
            where RowNumber = 1
        ) q1
        
        LEFT JOIN
        
        (
            SELECT
            commoditycode,unitcode, price as p2, date as d2
            FROM
            (
              SELECT  @row_num := IF(@prev_value=o.commoditycode,@row_num+1,1) AS RowNumber
                    ,o.unitcode
                   ,o.commoditycode
                   ,o.value1 as price
                   ,o.date
                   ,@prev_value := o.commoditycode
              FROM (
                SELECT
                    unitcode, 
                    amiscurrentdata.commoditycode,
                    avg(value1) as value1,
                    date
                FROM amiscurrentdata
                INNER JOIN amiscommodity
                ON amiscurrentdata.commoditycode = amiscommodity.commoditycode
                WHERE is_exposed = TRUE  AND amiscurrentdata.datasourcecode='SMS'
                GROUP BY unitcode, commoditycode, YEAR(date), MONTH(date), DAY(date)
              ) o,
                  (SELECT @row_num := 1) x,
                  (SELECT @prev_value := '') y
              WHERE DATE(date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
              ORDER BY o.date DESC
            ) b
            where RowNumber = 2
        ) q2
        
        ON q1.commoditycode = q2.commoditycode
        
        LEFT JOIN amiscommoditylocale 
        ON q1.commoditycode = amiscommoditylocale.commoditycode 
        LEFT JOIN amisunitlocale 
        ON q1.unitcode = amisunitlocale.unitcode 
        
        WHERE 
        amiscommoditylocale.cultureid = $locale
        AND
        amisunitlocale.cultureid = $locale
        ";

        $querySql = "
        SELECT 
            q1.commoditycode as name,
            q1.unitcode as unit,
            p1 as latestPrice,
            d1 as latestUpdate,
            p2 as previousPrice,
            d2 as previousUpdate
    
        $baseSql
    
        ";

        $countSql = "
        SELECT count(*) as c
        $baseSql
        ";
        //return $querySql;
        $result =  DB::select($querySql);
        $count = DB::select($countSql);
        $commodities = array();
        //$arr = explode(":",$count[0]."");
        //dd($count[0]->c);
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

        return response(array(
            $commodities,
            $count[0]->c
        ),200)->json();
    }
    function textToUnicode($text) {
        if (preg_match('/^\&\#/', trim($text))) {
            return html_entity_decode($text, ENT_NOQUOTES, 'UTF-8');
        }
        return $text;
    }

}
