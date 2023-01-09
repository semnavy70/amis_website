@extends('master')

@section('site-title','Home - Agricultural Market Information Service')
<style>
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(112, 122, 27, 0.15);
    }
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 100px;
        height: 100px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
        position: absolute;
        left: 45%;
        top: 62%;
    }
    .loader1 {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 100px;
        height: 100px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
        position: absolute;
        left: 45%;
        top: 45%;
        z-index: 1000;
    }

        /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    #flexslider-carousel {
        margin: 0 auto;
        width: 100%;
    }
    .flex-next{
        display: none !important;
    }
    .flex-prev{
        display: none !important;
    }

    /*----------------------------------
    [ product-thumb / .product-thumb ]
    ----------------------------------- */
    .product-thumb{
        margin-bottom:50px;
        border:3px solid transparent;
        border-radius:10px;
        border-bottom:none;
        transition: all 0.5s ease;
    }
    .product-thumb:hover{
        box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.30);
        border:3px solid #fff;
        border-bottom:none;
    }
    .product-thumb .image{
        background:#F3F3F3;
        border-radius:10px 10px 0 0;
        position:relative;
    }
    .product-thumb:hover .image a {
        opacity: 0.4;
    }
    .product-thumb .image img{
        margin:0 auto;
    }
    .product-thumb .image .onhover{
        position:absolute;
        right:15px;
        bottom:-25px;
    }
    .product-thumb .image .onhover ul li + li{
        margin-top:10px;
    }
    .product-thumb .image .onhover button{
        background:#13d22e;
        border:none;
        color:#fff;
        padding:12px 14px 13px;
        border-radius:50%;
        width:50px;
        height:50px;
        text-align:center;
    }
    .product-thumb .image .onhover button:hover{
        background:#17161f;
    }
    .product-thumb .image .onhover button i{
        font-size:24px;
    }
    .product-thumb .caption{
        padding:22px 14px 0;
        min-height:80px;
        border:1px solid #f3f3f3;
        border-radius:0 0px 10px 10px;
        background-color: #f9f9f9;
        border-top:none;
    }
    .product-thumb:hover .caption{
        border-color:transparent;
    }
    .product-thumb .caption h4{
        font-size:18px;
        font-weight:400;
        margin:0 0 10px;
    }
    .product-thumb .caption h4 a{
        color:#686868;
    }
    .product-thumb .caption h4 span{
        font-weight:700;
    }
    .product-thumb .caption .price{
        font-size:24px;
        font-weight:700;
        color:#707a19;
    }
    .product-thumb .caption .weigh{
        font-size: 24px;
        font-weight: 700;
        color: #707a19;
        /* vertical-align: middle; */
        text-align: center;
        margin-top: 20px;
    }
    .product-thumb .caption .rating i{
        color:686868;
        margin-right:5px;
    }
    .product-thumb .caption .des{
        font-size:14px;
        color:#686868;
        line-height:24px;
        margin:30px 0 25px;
    }
    .product-thumb .caption .button-group button{
        background:none;
        border-radius:50%;
        border:1px solid #ccc;
        color:#686868;
        padding:7px 11px;
        font-size:16px;
    }
    .product-thumb .caption .button-group button + button{
        margin-left:10px;
    }
    .product-thumb .caption .button-group button:hover{
        background:#13d22e;
        color:#fff;
        border:1px solid #13d22e;
    }
    .product-thumb .caption .des, .product-thumb .caption .rating, .product-thumb .caption .button-group, .product-list .product-thumb .image .onhover{
        display:none;
    }
    .product-list .product-thumb .caption .des, .product-list .product-thumb .caption .rating, .product-list .product-thumb .caption .button-group{
        display:block;
    }
    .product-list .product-thumb{
        border:none;
        min-height:260px;
    }
    .product-list .product-thumb .image {
        float:left;
        border-radius:10px;
    }
    .product-list .product-thumb:hover{
        box-shadow: none;
    }
    .product-list .product-thumb:hover .image{
        margin:0;
    }
    .product-list .product-thumb:hover .image a {
        opacity: 100;
    }
    .product-list .product-thumb .caption {
        margin-left:270px;
        padding:0 0 0 30px;
        border:none;
    }
    .main-info-min-height{
        min-height: 340px;
    }
    .main-title{
        color:#707a19;
    }

</style>


<link href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.2.2/flexslider-min.css" type="text/css" rel="stylesheet" />
@section('content')
    @if (Auth::user() != null)
        <input type="hidden" name="canEdit" id="canEdit" value="1">
    @else
        <input type="hidden" name="canEdit" id="canEdit" value="0">
    @endif
    <div class="content position-relative">
        <div class="container">
            <div class="block-home">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="box-item">
                            <a href="{{ app_url('topic/news-and-events') }}" class="box orange">
                                <img src="{{ url('assets/img/news.png') }}" alt="">
                            </a>
                            <h5>
                                @lang('translator.news_and_events')
                            </h5>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="box-item">
                            <a href="{{ app_url('market') }}" class="box green">
                                <img src="{{ url('assets/img/online-market.png') }}" alt="">
                            </a>
                            <h5>
                                @lang('translator.online_market')
                            </h5>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="box-item">

                            <a href="{{ app_url('bussiness') }}" class="box red">
                                <img src="{{ url('assets/img/information.png') }}" alt="">
                            </a>
                            <h5>
                                @lang('translator.sms_service')
                            </h5>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <div class="box-item">
                            <a href="{{ app_url('document/monthly-price-bulletin') }}" class="box brand">
                                <img src="{{ url('assets/img/record.png') }}" alt="">
                            </a>
                            <h5>
                                @lang('translator.information')
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <section class="welcome">
                <h3>@lang('translator.welcome')
                    <span style="color: #707A1A">@lang('translator.amis_website')</span>
                </h3>
                <span class="b-line"></span>
                <p>@lang('translator.description')</p>
            </section>

            <section class="monthly">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-7 pl-0 pr-3">
                        <div class="shadow-sm p-3 bg-white rounded main-info-min-height">
                            @php $item = $monthly->translate(App::getLocale()); @endphp
                            <h4 class="text-center mb-3 main-title">{{ $item->title }}</h4>
                            <span class="b-line mb-3"></span>
                            <div class="row">
                                <div class="col-lg-7 col-md-12 col-sm-12 order-lg-2">
                                    <div class="monthly-content">
                                        <div class="p-0 mb-0">
                                            {!! $item->excerpt !!}
                                        </div>
                                        <a href="{{ getLink($item) }}" class="float-right pt-3 pr-2">@lang('translator.read_more')
                                            <span>
                                            <i class="fas fa-angle-double-right"></i>
                                        </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12 order-lg-1">
                                    <div class="box-img">
                                        <img src="{{ gcpUrl($item->image) }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-12 col-sm-12 col-md-5 pl-0 pr-0 ">
                        <div class="shadow-sm p-3 bg-white rounded main-info-min-height">
                            @php $item = $production->translate(App::getLocale()); @endphp
                            <h4 class="text-center mb-3 main-title"> @lang('translator.production_and_production_export')</h4>
                            <span class="b-line mb-3"></span>
                            <div class="row">
                                <div class="col-12">
                                    <div class="monthly-content">

                                        <div class="box-img">
                                            <img src="{{ gcpUrl($item->image) }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="row mb-2 pt-4">
                                            <div class="col-6">
                                                <a href="{{ route('voyager.products.map') }}" class="float-left pt-3 mt-3 pr-2">@lang('translator.production')
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('voyager.productexport.index') }}" class="float-right pt-3 mt-3 pr-2">@lang('translator.productionexport')
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </section>
            <section class="tables">
                <div class="title">
                    <h3 class="text-center">@lang('translator.recent_price')</h3>
                    <span class="b-line mb-3"></span>

                </div>
                @if(App::getLocale()=='kh')
                    {{-- <a href="export"  id="btn-daily1">ទាញយក <span class="fa fa-file-excel"></span></a> --}}
                    <a href="{{app_url('export')}}">ទាញយក <span class="fa fa-file-excel"></span></a>
                @elseif(App::getLocale()=='en')
                    <a href="{{app_url('export')}}">Export <span class="fa fa-file-excel"></span></a>

                @endif
                <!-- <div class="row"> -->
                
                 <div id="LatestProductContainer" style="width: 100%;" data-url="https://tmp.camagrimarket.org/api/website/report/latest_product" data-locale="{{App::getLocale()=='kh'?2:1}}"></div>
                   
                <!-- </div> -->
            </section>

            <section class="chart mw-100">
                <h3 class="text-center">@lang('translator.price_fluc')</h3>
                <div class="b-line"></div>
                <form action="" method="post" style="margin-bottom: 10px">
                    <div class="row" style="margin-bottom: 10px;border: 1px solid #eee;padding: 25px;background-color: #fff; margin-left: 0px; margin-right: 0px;">
                        <div class="col-3 col-md-3">
                            <div class="form-group">
                                <label for="category">@lang('translator.category')</label>
                                @if(App::getLocale()=='kh')
                                    <select class="form-control" name="category" id="Category" data-url="{{ url('api/marketapp/commodities-categories') }}" data-locale="2"></select>
                                @elseif(App::getLocale()=='en')
                                    <select class="form-control" name="category" id="Category" data-url="{{ url('api/marketapp/commodities-categories') }}" data-locale="1"></select>
                                @endif
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            <div class="form-group">
                                <label for="commodity">@lang('translator.commodity')</label>
                                @if(App::getLocale()=='kh')
                                    <select class="form-control" name="commodity" id="Commodity" data-url="{{ url('api/marketapp/category-commodities') }}" data-locale="2"></select>
                                @elseif(App::getLocale()=='en')
                                    <select class="form-control" name="commodity" id="Commodity" data-url="{{ url('api/marketapp/category-commodities') }}" data-locale="1"></select>
                                @endif
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            <div class="form-group">
                                <label for="commodity1">@lang('translator.commodity2')</label>
                                @if(App::getLocale()=='kh')
                                    <select class="form-control" name="commodity1" id="Commodity1" data-url="{{ url('api/marketapp/category-commodities') }}" data-locale="2"></select>
                                @elseif(App::getLocale()=='en')
                                    <select class="form-control" name="commodity1" id="Commodity1" data-url="{{ url('api/marketapp/category-commodities') }}" data-locale="1"></select>
                                @endif
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            <div class="form-group">
                                <label for="commodity2">@lang('translator.commodity3')</label>
                                @if(App::getLocale()=='kh')
                                    <select class="form-control" name="commodity2" id="Commodity2" data-url="{{ url('api/marketapp/category-commodities') }}" data-locale="2"></select>
                                @elseif(App::getLocale()=='en')
                                    <select class="form-control" name="commodity2" id="Commodity2" data-url="{{ url('api/marketapp/category-commodities') }}" data-locale="1"></select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-5 col-md-2">
                        <div class="form-check">
                            @if(App::getLocale()=='kh')
                                <input type="checkbox" class="form-check-input" checked name="dataseries1" value="WP" >
                                <label class="form-check-label">@lang('translator.wholesale')</label>
                            @elseif(App::getLocale()=='en')
                                <input type="checkbox" class="form-check-input" checked name="dataseries1" value="WP">
                                <label class="form-check-label">@lang('translator.wholesale')</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-5 col-md-2">
                        <div class="form-check">
                            @if(App::getLocale()=='kh')
                                <input type="checkbox" class="form-check-input" name="dataseries1" value="RP" >
                                <label class="form-check-label">@lang('translator.retail')</label>
                            @elseif(App::getLocale()=='en')
                                <input type="checkbox" class="form-check-input" name="dataseries1" value="RP" >
                                <label class="form-check-label">@lang('translator.retail')</label>
                            @endif
                        </div>
                    </div>
                </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="loader1" id="loader1"></div>
                        @if(App::getLocale()=='kh')
                            <div id="PriceChartContainer" data-url="https://tmp.camagrimarket.org/api/website/report/price?maxAge=5&" data-locale="2" data-maxlines="3" style="min-height: 450px; background-color: white;width: 100%; margin: 0 auto">
                                <div id="high-chart" series="[]" data-highcharts-chart="1">

                                </div>
                            </div>
                        @elseif(App::getLocale()=='en')
                            <div id="PriceChartContainer" data-url="https://tmp.camagrimarket.org/api/website/report/price?maxAge=5&" data-locale="1" data-maxlines="3" style="min-height: 400px; width: 100%; margin: 0 auto">
                                <div id="high-chart" series="[]" data-highcharts-chart="1">

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="tables">
                <div class="title">
                    <h3 class="text-center">@lang('translator.price_monthly')
                        @if(App::getLocale()=='kh')
                            {{$month}}
                        @elseif(App::getLocale()=='en')
                            of {{$monthEN}}
                        @endif
                    </h3>
                    <span class="b-line mb-3"></span>
                </div>
                <div class="row">


                    <div class="col-5 col-md-2">
                        <div class="form-check">
                            @if(App::getLocale()=='kh')
                                <input type="checkbox" class="form-check-input" checked name="dataseries" data-url="https://tmp.camagrimarket.org/api/website/report/monthly/RP/2">
                                <label class="form-check-label">@lang('translator.wholesale')</label>
                            @elseif(App::getLocale()=='en')
                                <input type="checkbox" class="form-check-input" checked name="dataseries" data-url="https://tmp.camagrimarket.org/api/website/report/monthly/RP/1">
                                <label class="form-check-label">@lang('translator.wholesale')</label>
                            @endif
                        </div>                        
                    </div>
                    <div class="col-5 col-md-2">
                        <div class="form-check">                            
                                @if(App::getLocale()=='kh')
                                <input type="checkbox" class="form-check-input" name="dataseries" data-url="https://tmp.camagrimarket.org/api/website/report/monthly/WP/2">
                                <label class="form-check-label">@lang('translator.retail')</label>
                            @elseif(App::getLocale()=='en')
                                <input type="checkbox" class="form-check-input" name="dataseries" data-url="https://tmp.camagrimarket.org/api/website/report/monthly/WP/1">
                                <label class="form-check-label">@lang('translator.retail')</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-2">
                        @if(App::getLocale()=='kh')
                            <a href="#" id="xx">ទាញយក <span class="fa fa-file-excel"></span></a>
                        @elseif(App::getLocale()=='en')
                            <a href="#" id="xx">Export <span class="fa fa-file-excel"></span></a>
                        @endif
                    </div>
                </div>
                <div class="row" style="overflow-x:auto; min-height: 450px; margin-top: 10px; background-color: white; width: 100%; margin-left: 0px;">
                    <table class="table table-striped" id="montly_report" style="font-size: 12px;"></table>
                    <div class="loader" id="loader"></div>
                </div>
                {{-- <div class="row" style="width: 100%; margin-left: 0px;">
                    <div class="alert alert-light" role="alert" style="width:100%;">
                        <h6 class="alert-heading">Legend</h6>
                        <hr>
                        <p><i class='fa fa-caret-up text-danger' aria-hidden='true'></i>&nbsp; Percent of price change month on month increase above price fluctuation of 5%</p>
                        <p><i class='fa fa-caret-right text-warning' aria-hidden='true'></i>&nbsp; Percent of price change month within normal price fluctuation of 5%</p>
                        <p><i class='fa fa-caret-down text-success' aria-hidden='true'></i>&nbsp; Percent of price change month on month increase below price fluctuation of 5%</p>
                        <p>- Commodity not available in reporting month</p>
                    </div>
                </div> --}}
                
            </section>

            <section class="last-news">
                <h3 class="text-center">@lang('translator.latest')</h3>
                <div class="b-line"></div>
                <div class="content-news">
                    <div class="row">
                        @foreach($news as $item)
                        @php $item = $item->translate(App::getLocale()); @endphp
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-img position-relative">
                                    @if($item->image == "")
                                    <img class="card-img-top rounded-0" src="{{ url('assets/img/no-photo.png') }}" class="img-fluid" alt="">
                                    @else
                                    <img class="card-img-top rounded-0" src="{{ gcpUrl($item->image) }}" class="img-fluid" alt="">
                                    <div class="video-icon">
                                    <i class="fab fa-youtube fa-3x shadow"><div class="bgicon" style="height: 20px;width: 20px;background-color: #fff;margin-top: -34px;margin-left: 17px;"></div></i></div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h6>{{ $item->title }}</h6>
                                    <div class="line"></div>
                                    <p>{{ $item->excerpt }}</p>

                                    <a href="{{ getLink($item) }}">@lang('translator.read_more')
                                        <span>
                                            <i class="fas fa-angle-double-right"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @if(App::getLocale()=='kh')
                <section class="last-news">
                    <h3 class="text-center">ផលិតផល</h3>
                    <div class="b-line"></div>
                    <div class="content-news">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/1.png" alt="image" title="image" class="img-responsive"></a>
                                    </div>
                                    <div class="caption">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>បន្លែ</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p class="price">ប៉េងបោះ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/7.png" alt="image" title="image" class="img-responsive"></a>
                                    </div>
                                    <div class="caption">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>បន្លែ</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p class="price">ផ្កាខាត់ណា</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/3.png" alt="image" title="image" class="img-responsive"></a>
                                    </div>
                                    <div class="caption">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>បន្លែ</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p class="price">ខ្ទឹមក្រហម</p>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            @elseif(App::getLocale()=='en')
                <section class="last-news">
                    <h3 class="text-center">Product</h3>
                    <div class="b-line"></div>
                    <div class="content-news">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/1.png" alt="image" title="image" class="img-responsive"></a>
                                    </div>
                                    <div class="caption">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Vegetable</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p class="price">Tomato</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/7.png" alt="image" title="image" class="img-responsive"></a>
                                    </div>
                                    <div class="caption">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Vegetable</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p class="price">Cauliflower</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <div class="product-thumb">
                                    <div class="image">
                                        <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/3.png" alt="image" title="image" class="img-responsive"></a>
                                    </div>
                                    <div class="caption">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Vegetable</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p class="price">Shallot</p>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                </section>
            @endif

            <section class="sponsor">
                <h3 class="text-center">@lang('translator.partners')</h3>
                <div class="b-line"></div>
                {{-- <div class="content-news">
                <div id="flexslider-carousel" class="flexslider">
                    <ul class="slides">
                        <li style="margin-left: 10px;margin-top: 10px;margin-bottom: 10px;">
                            <img src="{{ url('assets/img/s-1.gif') }}" height="60" />
                        </li>
                        <li style="margin-left: 60px;margin-top: 10px;margin-bottom: 10px;">
                            <img src="{{ url('assets/img/EU.png') }}" height="60" />
                        </li >
                        <li style="margin-left: 40px; margin-top: 10px;margin-bottom: 10px;">
                            <img src="{{ url('assets/img/PlusGate_Cellcard.png') }}" height="60" />
                        </li>
                        <li style="margin-left: 30px;margin-top: 10px;margin-bottom: 10px;">
                            <img src="{{ url('assets/img/wfp.png') }}" height="60" />
                        </li>
                    </ul>
                </div>
                </div> --}}
                <div class="content-news">
                    <div class="row">
                        <div class="col-6 col-md-2">
                            <img src="{{ url('assets/img/agri2.png') }}" height="60" />
                        </div>
                        <div class="col-6 col-md-3">
                            <img src="{{ url('assets/img/EU.png') }}" height="60" />
                        </div>
                        <div class="col-12 col-md-2">
                            <img src="{{ url('assets/img/wfp.png') }}" height="60" />                            
                        </div>
                        <div class="col-12 col-md-4">
                            <img src="{{ url('assets/img/PlusGate_Cellcard.png') }}" height="60" />
                        </div>                        
                    </div>
                </div>
            </section>
        </div>
    </div>
<input type="hidden" id="wsale" value="@lang('translator.wholesale')"/>
<input type="hidden" id="rprice" value="@lang('translator.retail')"/>
<input type="hidden" id="price" value="@lang('translator.price_riel')"/>
{{Counter::count('/')}}
@endsection

@section('chart-js')

    <script src="{{ url('assets/js/highcharts.js')}}"></script>
    <script src="https://code.highcharts.com/modules/boost.js"></script>
    <script src="{{ url('assets/js/exporting.js')}}?v=3"></script>
    <script src="{{ url('assets/js/prices-fluctuation.js?v=7') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.2.2/jquery.flexslider-min.js"></script>
    
    <script type="text/javascript">

        $(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                animationLoop: true,
                itemWidth: 320,
                itemMargin: 50
            });
        });

        var serial="WP";
        var LatestProductLoader = (function() {
            'use strict';

            var load = function() {
                var container = $('#LatestProductContainer');
                var link = $('#LatestProductMore');
                var url = container.data('url');
                var locale = container.data('locale');
                var start = link.data('start');
                var limit = link.data('limit');

                url += '?locale=' + locale
                if (start !== undefined) url += '&start=' + start;
                if (limit !== undefined) url += '&limit=' + limit;

                $.ajax({
                    url: url,
                })
                    .done(function(data) {
                        container.html(data);
                    });

            };

            return {
                load : load
            };
        }());

        window.load = LatestProductLoader.load();
    </script>

    <script>
        String.prototype.toUnicode = function(){
            var result = "";
            for(var i = 0; i < this.length; i++){
                var partial = this[i].charCodeAt(0).toString(16);
                while(partial.length !== 4) partial = "0" + partial;
                result += "\\u" + partial;
            }
            return result;
        };

        $(document).ready(function(){            
            var url = $("input:checkbox[name='dataseries'][checked]").data('url');
            console.log(url);
            var data = getdata(url);
            function exportTableToCSV($table, filename) {
    
            // Export Excel
                var $rows = $table.find('tr:has(td),tr:has(th)'),

                    // Temporary delimiter characters unlikely to be typed by keyboard
                    // This is to avoid accidentally splitting the actual contents
                    tmpColDelim = String.fromCharCode(11), // vertical tab character
                    tmpRowDelim = String.fromCharCode(0), // null character

                    // actual delimiter characters for CSV format
                    colDelim = '","',
                    rowDelim = '"\r\n"',

                    // Grab text from table into CSV formatted string
                    csv = '"' + $rows.map(function (i, row) {
                        var $row = $(row), $cols = $row.find('td,th');

                        return $cols.map(function (j, col) {
                            var $col = $(col), text = $col.text();

                            return text.replace(/"/g, '""'); // escape double quotes

                        }).get().join(tmpColDelim);

                    }).get().join(tmpRowDelim)
                        .split(tmpRowDelim).join(rowDelim)
                        .split(tmpColDelim).join(colDelim) + '"',

                    // Data URI
                    csvData = "data:text/csv;charset=utf-8,%EF%BB%BF" + encodeURI(csv);
                    //console.log(csvData);
                    // alert("みどりいろ".toUnicode());
                    console.log(csv);

                    if (window.navigator.msSaveBlob) { // IE 10+
                        //alert('IE' + csv);
                        window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/csv;charset=utf-8;"}), "csvname.csv")
                    }
                    else {
                        console.log($(this));
                        $(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' });
                    }
            }

            function export2TableToCSV($table,$table1, filename) {

                // Export Excel
                var $rows = $table.find('tr:has(td),tr:has(th)'),

                    // Temporary delimiter characters unlikely to be typed by keyboard
                    // This is to avoid accidentally splitting the actual contents
                    tmpColDelim = String.fromCharCode(11), // vertical tab character
                    tmpRowDelim = String.fromCharCode(0), // null character

                    // actual delimiter characters for CSV format
                    colDelim = '","',
                    rowDelim = '"\r\n"',

                    // Grab text from table into CSV formatted string
                    csv = '"' + $rows.map(function (i, row) {
                        var $row = $(row), $cols = $row.find('td,th');

                        return $cols.map(function (j, col) {
                            var $col = $(col), text = $col.text();

                            return text.replace(/"/g, '""'); // escape double quotes

                        }).get().join(tmpColDelim);

                    }).get().join(tmpRowDelim)
                        .split(tmpRowDelim).join(rowDelim)
                        .split(tmpColDelim).join(colDelim) + '"',

                    // Data URI
                    csvData = "data:text/csv;charset=utf-8,%EF%BB%BF" + encodeURI(csv);

                var test = csv;
                var result1 = csvData;
                var $rows = $table.find('tr:has(td)'),

                    // Temporary delimiter characters unlikely to be typed by keyboard
                    // This is to avoid accidentally splitting the actual contents
                    tmpColDelim = String.fromCharCode(11), // vertical tab character
                    tmpRowDelim = String.fromCharCode(0), // null character

                    // actual delimiter characters for CSV format
                    colDelim = '","',
                    rowDelim = '"\r\n"',

                    // Grab text from table into CSV formatted string
                    csv = '"' + $rows.map(function (i, row) {
                        var $row = $(row), $cols = $row.find('td,th');

                        return $cols.map(function (j, col) {
                            var $col = $(col), text = $col.text();

                            return text.replace(/"/g, '""'); // escape double quotes

                        }).get().join(tmpColDelim);

                    }).get().join(tmpRowDelim)
                        .split(tmpRowDelim).join(rowDelim)
                        .split(tmpColDelim).join(colDelim) + '"',

                    // Data URI
                    csvData = encodeURI(csv);
                var test = test +'\r\n'+csv;
                console.log(test);
                var result = result1 +'\r\n'+ csvData;
                //console.log(csvData);
                // alert("みどりいろ".toUnicode());
                console.log(result);

                if (window.navigator.msSaveBlob) { // IE 10+
                    //alert('IE' + csv);
                    window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/csv;charset=utf-8;"}), "csvname.csv")
                }
                else {
                    $(this).attr({ 'download': filename, 'href': result, 'target': '_blank' });
                }
            }


        // This must be a hyperlink
        $("#xx").on('click', function (event) {
            
            exportTableToCSV.apply(this, [$('#montly_report'), 'monthly_report.csv']);
            
            // IF CSV, don't do event.preventDefault() or return false
            // We actually need this to be a typical hyperlink
        });
            $("#btn-daily1").on('click', function (event) {

                export2TableToCSV.apply(this, [$('#daily1'),$('#daily2'), 'daily_report.csv']);
                //exportTableToCSV.apply(this, [$('#daily2'), 'daily_report.csv']);

                // IF CSV, don't do event.preventDefault() or return false
                // We actually need this to be a typical hyperlink
            });

        });

        $("input:checkbox[name='dataseries']").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            var url = $(this).data('url');
            console.log(url);
            var data = getdata(url);
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
        });
        $("input:checkbox[name='dataseries1']").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {

                serial = $(this).val();
                // the name of the box is retrieved using the .attr() method
                // as it is assumed and expected to be immutable
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);

                PriceGraphLoader.load();
            } else {
                $box.prop("checked", false);
            }
        });
        function getdata(url){
            console.log(url);
            $('#loader').show();
            $.ajax({url: url, success: function(result){
                //console.log(result.length);
                if(result.length==0){
                    $('#montly_report').html("");
                    $('#loader').hide();
                }else{
                    
                    var s_head = "<thead><tr>";
                    var th1 = "<th style='min-width: 100px;text-align: left;padding: .4rem;color: #ffffff;background-color: #707a1b;'>@lang('translator.province')</th>";
                    var th2 = "<th style='min-width: 100px;text-align: left;padding: .4rem 0;color: #ffffff;background-color: #707a1b;'>@lang('translator.market')</th>";
                    var other_th = "";
                    for(var i=0;i<result[0]['commodity'].length;i++){
                        var item = result[0]['commodity'];
                        //console.log(unicodeToChar(item[i]["name"]));
                        other_th = other_th+"<th style='min-width: 80px;text-align: center;padding: .4rem 0;color: #ffffff;background-color: #707a1b;'>"+unicodeToChar(item[i]["name"])+" (KHR/KGS)"+"</th>";
                    }
                    var e_head = "</tr></thead>";

                    var head = s_head+th1+th2+other_th+e_head;

                    var s_body = "<tbody>";
                    var rows = "";
                    result.forEach(element => {
                        
                            var label = '{{ App::getLocale()=="kh" ? "name_kh":"name_en"}}';
                            var tr = "<tr>";
                            var td1 = "<td style='text-align: left;padding: .4rem;'>"+element['region'][label]+"</td>";
                            var td2 = "<td style='text-align: left;padding: .4rem 0;'>"+element['market'][label]+"</td>";
                            var other_td = "";
                            element['commodity'].forEach(element1 => {
                                if(parseFloat(element1["diff"])>0)
                                {
                                    other_td = other_td + "<td style='text-align: center;padding: .4rem 0;' title='"+parseFloat(Math.round(element1["p"] * 100) / 100).toFixed(2)+"%'>"+Math.round(element1["new"])+"&nbsp;<i class='fa fa-caret-up text-danger' aria-hidden='true'></i>"+"</td>";
                                }
                                else if(parseFloat(element1["diff"])<0)
                                {
                                    other_td = other_td + "<td style='text-align: center;padding: .4rem 0;' title='"+parseFloat(Math.round(element1["p"] * 100) / 100).toFixed(2)+"%'>"+Math.abs(Math.round(element1["new"]))+"&nbsp;<i class='fa fa-caret-down text-success' aria-hidden='true'></i>"+"</td>";
                                }
                                else if(parseFloat(element1["diff"])==0)
                                {
                                    if(parseFloat(element1["new"])==0){
                                        other_td = other_td + "<td style='text-align: center;padding: .4rem 0;'>"+" - "+"</td>";
                                    }else{
                                        other_td = other_td + "<td style='text-align: center;padding: .4rem 0;' title='"+parseFloat(Math.round(element1["p"] * 100) / 100).toFixed(2)+"%'>"+Math.abs(Math.round(element1["new"]))+"</td>";
                                    }

                                }
                                
                            });
                            var e_tr = "</tr>";
                            rows = rows + tr+td1+td2+other_td+e_tr;
                            
                        
                    });
                    var e_body = "</tbody>";

                    var body = s_body+rows+e_body;

                    var html = head+body;
                    $('#montly_report').html(html);
                    $('#loader').hide();
                }

            }});
        }
        function unicodeToChar(text) {
            return text;
        }
    </script>

@endsection