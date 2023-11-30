<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <meta content="DSM" property="og:site_name"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <title>ទំព័រដើម | CAMAGRIMARKET</title>

    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
    <link href="<?php echo e(asset(mix('/frontend/css/app.css'))); ?>" rel="stylesheet">

    <?php echo app(\Inertia\SSRHead\HeadManager::class)->format(4)->render()."\n"; ?>
    <script src="<?php echo e((mix('frontend/js/app.js'))); ?>" defer></script>

    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9QVHC41MHV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-9QVHC41MHV');
    </script>
</head>

<body>
<?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>

<script src="https://kit.fontawesome.com/7a302f7480.js" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/app.blade.php ENDPATH**/ ?>