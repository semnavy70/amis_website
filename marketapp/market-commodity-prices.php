<?php

require_once __DIR__ . '/../marketdbconfig.php';   

include (__DIR__ . '/inc/inc.sms-service-queries.php') ;

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

$markets = getCommodityPricePerMarketAndUserType($commodityCode, $userTypes, $locale);

echo json_encode($markets);
