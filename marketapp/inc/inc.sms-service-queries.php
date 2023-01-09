<?php

/**
* Returns the latest products prices for all commodities in the following form:
* - Returns an indexed array consisting of 
* 0 => indexed array of commodities with prices updates paginated according to the start and limit parameters
* 1 => total number of records 
*
* Each commodity in the array of commodities is an associative array with the following keys:
* - name: localized name of the commodity
* - unit: localized short name of the commodity's unit
* - latestPrice: last price update of that commodity
* - latestUpdate: the date at which this last price was inputed
* - previousPrice: the previous price of that commidity
* - previousUpdate: the date at which that previous price was updated
*
* @param int $locale
* @param int $start
* @param int $limit
* @param int $maxAge in days
*
* @return mixed array
*
*/
function getLatestProductsUpdates($locale = 1, $start = 0, $limit = 100, $maxAge = 1)
{

    //prices are sequentially added to the amiscurrentdata table
    //Use a rownumber to identify the records sorted by date and
    //join 2 subqueries selecting the latest and the previous records
    $baseSql = "
FROM

(
    SELECT
    comodity_code, unit_code, price as p1, mkt_date as d1
    FROM
    (
      SELECT  @row_num := IF(@prev_value=o.comodity_code,@row_num+1,1) AS RowNumber
            ,o.unit_code
           ,o.comodity_code
           ,o.value1 as price
           ,o.mkt_date
           ,@prev_value := o.comodity_code
      FROM (
        SELECT
            unitcode, 
            data.comodity_code,
            avg(value1) as value1,
            date
        FROM data
        INNER JOIN comodities
        ON data.comodity_code = comodities.code
        GROUP BY unit_code, comodity_code, YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
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
    comodity_code, unit_code, price as p2, mkt_date as d2
    FROM
    (
      SELECT  @row_num := IF(@prev_value=o.comodity_code,@row_num+1,1) AS RowNumber
            ,o.unitc_ode
           ,o.comodity_code
           ,o.value1 as price
           ,o.mkt_date
           ,@prev_value := o.comodity_code
      FROM (
        SELECT
            unit_code, 
            data.comodity_code,
            avg(value1) as value1,
            mkt_date
        FROM data
        INNER JOIN comodities
        ON data.comodity_code = comodities.code
        GROUP BY unit_code, comodity_code, YEAR(mkt_date), MONTH(mkt_date), DAY(mkt_date)
      ) o,
          (SELECT @row_num := 1) x,
          (SELECT @prev_value := '') y
      WHERE DATE(mkt_date) >= DATE(DATE_SUB(NOW(),INTERVAL $maxAge DAY))
      ORDER BY o.comodity_code, o.mkt_date DESC
    ) b
    where RowNumber = 2
) q2

ON q1.comodity_code = q2.comodity_code

LEFT JOIN unites 
ON q1.unit_code = unites.code
";

    $querySql = "
    SELECT 
        comodities.name_kh as name,
        comodities.name_en as name_en,
        unites.name_kh as unit,
        p1 as latestPrice,
        d1 as latestUpdate,
        p2 as previousPrice,
        d2 as previousUpdate

    $baseSql

    LIMIT $start, $limit
    ";

    $countSql = "
    SELECT count(*)
    $baseSql
    ";

    $result=mysql_query($querySql) or die("query failed:" . mysql_error());

    $commodities = array();
    while ($row = mysql_fetch_assoc($result)) {
        $commodities[] = array(
            'name' => textToUnicode($row['name']),
            'unit' => $row['unit'],
            'latestPrice' => $row['latestPrice'],
            'latestUpdate' => $row['latestUpdate'],
            'previousPrice' => $row['previousPrice'],
            'previousUpdate' => $row['previousUpdate']
        );
    }

    $result=mysql_query($countSql) or die("query failed:" . mysql_error());
    $count = mysql_fetch_array($result);

    return array(
        $commodities,
        $count[0]
    );

}

/**
* Get the list of Commodity categories
*
* @param $locale
* @return mixed array
*/
function getCommoditiesCategories($locale = 1)
{

    $sql = "
SELECT categorycode as categoryCode, name
FROM amiscategorylocale
WHERE cultureid = $locale    
    ";

    $result=mysql_query($sql) or die("query failed:" . mysql_error());

    $categories = array();
    while ($row = mysql_fetch_assoc($result)) {
        $categories[] = array(
            'categoryCode' => $row['categoryCode'],
            'name' => $row['name']
        );
    }
    return $categories;
}

/**
* Get the Commodities in a category
*
* @param int $categoryCode
* @param int $locale
* @return mixed array
*/
function getCommoditiesOfCategory($categoryCode, $locale = 1)
{

    $sql = "
SELECT amiscommodity.commoditycode as commodityCode, name
FROM amiscommodity
LEFT JOIN amiscommoditylocale
ON amiscommodity.commoditycode = amiscommoditylocale.commoditycode
WHERE cultureid = $locale
AND is_exposed = TRUE
AND categorycode = $categoryCode
    ";

    $result=mysql_query($sql) or die("query failed:" . mysql_error());

    $commodities = array();
    while ($row = mysql_fetch_assoc($result)) {
        $commodities[] = array(
            'commodityCode' => $row['commodityCode'],
            'name' => textToUnicode($row['name'])
        );
    }
    return $commodities;
}

/**
* Get all the prices recorded for a commodity per market
*
* @param int $commoditycode
* @param array $userTypes
* @param int $locale
*
* @return mixed array
*/
function getCommodityPricePerMarketAndUserType($commodityCode, $userTypes = array(), $locale = 1)
{

    $sql = "
SELECT amisdata.marketcode, usertypeid, name, date, AVG(value1) as price
FROM amisdata
LEFT JOIN amismarketlocale
ON amisdata.marketcode = amismarketlocale.marketcode
WHERE commoditycode = $commodityCode
AND cultureid = $locale
    ";

    if (sizeof($userTypes) > 0) {
      $sql .= " AND usertypeid in ( " . join(',', $userTypes) . ")";
    }

    $sql .= " GROUP BY YEAR(date), MONTH(date), DAY(date)";

    $result=mysql_query($sql) or die("query failed:" . mysql_error());

    $markets = array();
    while ($row = mysql_fetch_assoc($result)) {
        if (!isset($markets[$row['marketcode']][$row['usertypeid']])) {
            $markets[$row['marketcode']][$row['usertypeid']] = array(
              'code' => $row['marketcode'],
              'userType' => $row['usertypeid'],
              'name' => textToUnicode($row['name']),
              'prices' => array()
            );
        }
        $markets[$row['marketcode']][$row['usertypeid']]['prices'][] = array(
          'date' => $row['date'],
          'price' => $row['price']
        );
    }

    $result = array();
    foreach($markets as $market) {
      $result = array_merge($result, array_values($market));
    }

    return $result;
}

/**
* Get all the prices recorded for a commodity per province
*
* @param int $commoditycode
* @param array $userTypes
* @param int $locale
*
* @return mixed array
*/
function getCommodityPricePerProvinceAndUserType($commodityCode, $userTypes = array(), $locale = 1)
{

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

    $result=mysql_query($sql) or die("query failed:" . mysql_error());

    $regions = array();
    while ($row = mysql_fetch_assoc($result)) {
        if (!isset($regions[$row['regioncode']][$row['usertypeid']])) {
            $regions[$row['regioncode']][$row['usertypeid']] = array(
              'code' => $row['regioncode'],
              'userType' => $row['usertypeid'],
              'name' => textToUnicode($row['name']),
              'prices' => array()
            );
        }
        $regions[$row['regioncode']][$row['usertypeid']]['prices'][] = array(
          'date' => $row['date'],
          'price' => $row['price']
        );
    }

    $result = array();
    foreach($regions as $region) {
      $result = array_merge($result, array_values($region));
    }

    return $result;
}

/**
* Get all the prices recorded for a commodity
*
* @param int $commoditycode
* @param in $maxAge expressed in years
* @param int $locale
*
* @return mixed array
*/
function getCommodityPrices($commodityCode, $maxAge = null, $locale = 1)
{

    $sql = "
SELECT amisdata.commoditycode, name, date, AVG(value1) as price
FROM amisdata
LEFT JOIN amiscommoditylocale
ON amisdata.commoditycode = amiscommoditylocale.commoditycode
WHERE amisdata.commoditycode = $commodityCode
AND cultureid = $locale
    ";

    if ($maxAge !== null) {
        $sql .= " AND date >= DATE_SUB(NOW(),INTERVAL $maxAge YEAR)";
    }

    $sql .= " GROUP BY YEAR(date), MONTH(date), DAY(date)";

    $result=mysql_query($sql) or die("query failed:" . mysql_error());

    $prices = array();
    while ($row = mysql_fetch_assoc($result)) {
        if (!isset($prices[$row['commoditycode']])) {
            $prices[$row['commoditycode']] = array(
              'code' => $row['commoditycode'],
              'name' => textToUnicode($row['name']),
              'prices' => array()
            );
        }
        $prices[$row['commoditycode']]['prices'][] = array(
          'date' => $row['date'],
          'price' => $row['price']
        );
    }

    $result = array_values($prices);

    return $result;
}

/**
* Get all commodities
*
* @param int $locale
* @return mixed array
*/
function getCommodities($locale = 1)
{

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

    $result=mysql_query($sql) or die("query failed:" . mysql_error());

    $commodities = array();
    while ($row = mysql_fetch_assoc($result)) {
        $commodities[] = array(
            'commodityCode' => $row['commodityCode'],
            'name' => textToUnicode($row['name']),
            'smsCode' => $row['smsCode']
        );
    }
    return $commodities;
}

/**
* Get all markets
*
* @param int $locale
* @return mixed array
*/
function getMarkets($locale = 1)
{

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

    $result=mysql_query($sql) or die("query failed:" . mysql_error());

    $markets = array();
    while ($row = mysql_fetch_assoc($result)) {
        $markets[] = array(
            'marketCode' => $row['marketCode'],
            'name' => textToUnicode($row['name']),
            'smsCode' => $row['smsCode'],
            'regionName' => textToUnicode($row['regionName'])
        );
    }
    return $markets;
}

/**
* It seems that some Khmer text in the database is HTML encoded instead of unicode
* This function attempts to return the unicode representation of the html entity
**/
function textToUnicode($text) {
    if (preg_match('/^\&\#/', trim($text))) {
        return html_entity_decode($text, ENT_NOQUOTES, 'UTF-8');
    }
    return $text;
}