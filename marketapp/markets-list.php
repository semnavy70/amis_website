<?php


require_once __DIR__ . '/../marketdbconfig.php';   

include (__DIR__ . '/inc/inc.sms-service-queries.php') ;

$locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;

$markets = getMarkets($locale);

echo json_encode($markets);