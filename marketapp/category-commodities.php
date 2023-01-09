<?php


require_once __DIR__ . '/../marketdbconfig.php';   

include (__DIR__ . '/inc/inc.sms-service-queries.php') ;

if (! isset($_REQUEST['categoryCode'])) {
    return;
}

$locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
$categoryCode = intval($_REQUEST['categoryCode']);

$commodities = getCommoditiesOfCategory($categoryCode, $locale);

echo json_encode($commodities);