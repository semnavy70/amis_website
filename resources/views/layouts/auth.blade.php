<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') - {{ setting('app_name') }}</title>

    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-16x16.png') }}" sizes="16x16"/>

    {!! HTML::style('assets/css/app.css') !!}
    {!! HTML::style('assets/css/fontawesome-all.min.css') !!}

    @yield('header-scripts')

    @hook('auth:styles')
</head>
<body class="auth">

<div class="container">
    @yield('content')
</div>

{!! HTML::script('assets/js/vendor.js') !!}
{!! HTML::script('assets/js/as/app.js') !!}
{!! HTML::script('assets/js/as/btn.js') !!}
@yield('scripts')
@hook('auth:scripts')
</body>
</html>
