<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta content="DSM" property="og:site_name"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <title>ទំព័រដើម | CAMAGRIMARKET</title>

    @routes
    <link href="{{ asset(mix('/frontend/css/app.css')) }}" rel="stylesheet">

    @inertiaHead
    <script src="{{ (mix('frontend/js/app.js')) }}" defer></script>

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
@inertia

<script src="https://kit.fontawesome.com/7a302f7480.js" crossorigin="anonymous"></script>
</body>
</html>
