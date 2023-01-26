<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ url('assets/img/favicon.ico') }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}?v=1">
    <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">
    <link rel="stylesheet" href=" https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.7.5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    @yield('product-css')
    @if(App::getLocale()=='en')
        <style>
            .menu .navbar .navbar-nav > .nav-item > .nav-link {
                text-transform: uppercase;
                padding: 2px 15px;
                font-weight: 600;
                font-size: 15px;
            }
        </style>
    @endif
    @if(Route::getCurrentRoute()->uri()=="bussiness" || Route::getCurrentRoute()->uri()=="en/bussiness")
        <style>
            header {
                background: #d40000;
                padding: 5px;
                position: relative;
            }
            .menu .navbar .navbar-nav > .nav-item.active {
                background-color: #d40000;
            }
            .detail{
                padding: 20px 20px;
            }
            a {
                color: #707A1A;
            }
        </style>
    @endif
    @if(Route::getCurrentRoute()->uri()=="topic/{slug}/{filter?}" || Route::getCurrentRoute()->uri()=="en/topic/{slug}/{filter?}")
        <style>
            header {
                background: #f60;
                padding: 2px;
                position: relative;
            }
            .menu .navbar .navbar-nav > .nav-item.active {
                background-color: #f60;
            }
        </style>
    @endif
    @if(Route::getCurrentRoute()->uri()=="document/{slug}" || Route::getCurrentRoute()->uri()=="en/document/{slug}" )
        <style>
            header {
                background: #08a;
                padding: 2px;
                position: relative;
            }
            .menu .navbar .navbar-nav > .nav-item.active {
                background-color: #08a;
            }
            .page-body h2{
                font-size: 1.7rem;
            }
        </style>
    @endif
    @if(Route::getCurrentRoute()->uri()=="market" || Route::getCurrentRoute()->uri()=="en/market" )
        <style>
            header {
                background:#4a0;
                padding: 2px;
                position: relative;
            }
            .menu .navbar .navbar-nav > .nav-item.active {
                background-color: #4a0;
            }
            .page-body h2{
                font-size: 1.7rem;
            }
            .detail{
                padding: 20px 20px;
            }
            a {
                color: #707A1A;
            }

        </style>
    @endif
    <title>@yield('site-title')</title>
</head>

<body>
    <header>
        <h1>{{ env("SESSION_DRIVER") }}</h1>
        <div class="lan text-white">
            <a href="{{url_switch_lang()}}" class="btn btn-lang btn-sm {{App::getLocale()=='kh'?'acitve':''}}">
                <img src="{{ url('assets/img/flag-kh.gif') }}" alt="Khmer">
            </a>
            |
            <a href="{{url_switch_lang('en')}}" class="btn btn-lang btn-sm {{App::getLocale()=='en'?'acitve':''}}">
                <img src="{{ url('assets/img/flag-en.gif') }}" alt="EN">
            </a>
        </div>
    </header>

    <div class="menu sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                <a href="{{ app_url('/') }}" class="navbar-brand">
                    <img src="https://amis.maff.gov.kh/assets/img/logo.png" width="74"  alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    {{ menu('front', 'share.bootstrap') }}
                </div>
            </nav>
        </div>
    </div>
    <div class="wrapper">
        <!-- Search Box -->
        <form action="{{route('home.search')}}" method="GET" role="search" style="margin:0px;">
            <div id="searchbox" class="searchbox">
                <i class="magnify fa fa-search" aria-hidden="true"></i>
                <i class="fa fa-times close" id="searchbox-close" aria-hidden="true"></i>
                <input id="search-input" name="search" type="text" placeholder="@lang('translator.search')" />
            </div>
        </form>
        <!-- End Search Box -->
        @if(isset($list_slide))
            @include('share.slide')
        @endif
        @yield('content')
        <footer class="footer">
            <div class="center-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>@lang('translator.other_link')</h5>
                            <div class="line"></div>

                                {!! links() !!}

                        </div>
                        <div class="col-md-3">
                            <h5>@lang('translator.agri_market_info')</h5>
                            <div class="line"></div>
                            <ul>
                                @if(isset($agri_info))
                                @foreach($agri_info as $item)
                                @php $item = $item->translate(App::getLocale()); @endphp
                                <li>
                                    <a href="{{ getLink($item) }}">{{ $item->title }}</a>
                                </li>
                                @endforeach
                                @endif

                                <li>
                                    <a href="{{ route('voyager.products.map') }}">@lang('translator.production')</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h5>@lang('translator.agri_market_office')</h5>
                            <div class="line"></div>
                            <ul>
                                @if(isset($agri_office))
                                @foreach($agri_office as $item)
                                @php $item = $item->translate(App::getLocale()); @endphp
                                <li>
                                    <a href="{{ getLink($item) }}">{{ $item->title }}</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h5>@lang('translator.address')</h5>
                            <div class="line"></div>
                            <p>
                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                @lang('translator.address_desc')

                            </p>
                            <p>
                                <i class="fas fa-mobile"></i>
                                <a href="tel:+85523 216 060">@lang('translator.phone')</a>
                            </p>
                            <p>
                                <i class="fas fa-envelope"></i>
                                <a href="{{app_url("page/contact-us")}}">@lang('translator.email')</a>
                            </p>
                            <p>
                                <i class="fab fa-facebook-square"></i>
                                <a href="https://www.facebook.com/profile.php?id=100009150599278">AMIS Facebook </a>
                            </p>
                            <p>
                                <i class="fas fa-users"></i>
                                @lang('translator.all_visitor') {{ Counter::allHits() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-footer">
                Copyrights © <?=date("Y")?> All Rights Reserved. Powered by
                <a href="https://kravanh.com/" class="text-white" target="_blank">
                    KRAVANH Technology. </a>
            </div>
        </footer>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"--}}
        {{--crossorigin="anonymous"></script>--}}
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>--}}
    <script src="{{ url('assets/js/app.js') }}" type="text/javascript"></script>
    @yield('product-js')

    @yield('alert')
    
    @yield('chart-js')

    @yield('script')

</body>

</html>