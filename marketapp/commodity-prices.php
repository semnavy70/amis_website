<?php

require_once __DIR__ . '/../marketdbconfig.php';   

include (__DIR__ . '/inc/inc.sms-service-queries.php') ;

if (! isset($_REQUEST['commodityCode'])) {
    return;
}

$locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
$commodityCode = intval($_REQUEST['commodityCode']);

$maxAge = null;
if (isset($_REQUEST['maxAge'])) {
    $maxAge = intval($_REQUEST['maxAge']);
}

$prices = getCommodityPrices($commodityCode, $maxAge, $locale);

echo json_encode($prices);
