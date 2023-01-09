<?php

require_once __DIR__ . '/../marketdbconfig.php';   

include (__DIR__ . '/inc/inc.sms-service-queries.php') ;
?>

<dl class="price-update clearfix">
    <?php
        $locale = isset($_REQUEST['locale']) ? intval($_REQUEST['locale']) : 1;
        $start = isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 0;
        $maxAge = isset($_REQUEST['maxAge']) ? intval($_REQUEST['maxAge']) : 100;
        $limit = 12;

        $commodities = getLatestProductsUpdates($locale, $start, $limit, $maxAge);

        $nextStart = $start + $limit;
        $linkClass = "pull-right";
        $linkLabel = 'Next';

        if ($start === 0 && $commodities[1] <= $limit) {
            $linkClass = "hidden";
        } else {
            if ( $start + $limit >= $commodities[1] ) {
                $nextStart = $start - $limit;
                $linkClass = "pull-left";
                $linkLabel = 'Prev';
            }
        }
    ?>

    <?php
        foreach($commodities[0] as $commodity) {
    ?>

        <?php
        
            $class = 'fa-sort-up';
            
            if( $commodity['previousPrice'] > $commodity['latestPrice'] ) {
                $class = 'fa-sort-down';
            }
        ?>
            
        <dd>
            <?= $commodity['name'] ?>
            <span>
                <?php echo number_format($commodity['latestPrice'],2); ?>/<?= $commodity['unit'] ?>
                <span class="fa <?= $class; ?>"></span>
            </span>
            <span>
                <?php echo date_format(date_create($commodity['latestUpdate']), 'd/m/Y'); ?>
            </span>
        </dd>

    <?php } ?>

</dl>

<a
    href="#"
    data-start="<?= $nextStart ?>"
    data-limit="<?= $limit ?>"
    onclick="LatestProductLoader.load(); return false;"
    class="<?= $linkClass ?>"
    id="LatestProductMore"
>
    <?= $linkLabel ?>
</a>
<h1>Hello World</h1>
