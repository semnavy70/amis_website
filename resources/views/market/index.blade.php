@extends('master')

<title>@lang('translator.online_market')</title>
@section('product-css')



<style>

    .image-additional {
        display: inline-block;
        width: 22.5%;
    }
    footer h5 {
        color: #fff;
    }
    header {
        background: #3d8a91;
        padding: 0px 0;
    }
    /*----------------------------------
    [ tab/nav ]
    ----------------------------------- */
    .nav-tabs {
        margin-bottom: 10px;
    }
    .nav-tabs .nav-item {
        min-width: 100px;
    }
    .nav-link{
        color: #707A1A;
        text-align: center !important;
    }

    /*----------------------------------
    [ product-thumb / .product-thumb ]
    ----------------------------------- */
    .product-thumb{
        margin-bottom:30px;
        border:3px solid transparent;
        border-radius:10px;
        border-bottom:none;
    }
    .product-thumb:hover{
        box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.30);
        border:3px solid #fff;
        border-bottom:none;
    }
    .product-thumb .image{
        background:#eceaea;
        border-radius:10px 10px 0 0;
        position:relative;
        min-height: 263px;
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

</style>
@endsection
@section('content')
@php
if(!isset($_GET["tab"])){
$_GET["tab"] = "all";
}
$agri_office = \App\Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
$agri_info = \App\Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();
@endphp
<div class="content-page">
    <div class="inner-intro market-bg">
        <div class="container">
            <div class="title">

                <h1>@lang('translator.online_market')</h1>

            </div>
        </div>
    </div>
    <div class="container">
        <ol class="breadcrumb hidden-xs">
            <li class="breadcrumb-item completed"><a href="{{app_url('/')}}">@lang('translator.home')</a></li>
            <li class="breadcrumb-item active"><a href="#">@lang('translator.online_market')</a></li>
        </ol>
        <section class="detail">
            <ul class="nav nav-tabs">
                @if($_GET["tab"]=="all")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("market?tab=all")}}">@lang('translator.all')</a></li>
                @else
                <li  class="nav-item"><a class="nav-link" href="{{app_url("market?tab=all")}}">@lang('translator.all')</a></li>
                @endif

                @if($_GET["tab"]=="vegetable")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("market?tab=vegetable")}}">@lang('translator.vegetable')</a></li>
                @else
                <li class="nav-item"><a class="nav-link" href="{{app_url("market?tab=vegetable")}}">@lang('translator.vegetable')</a></li>
                @endif

                @if($_GET["tab"]=="fruit")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("market?tab=fruit")}}">@lang('translator.fruit')</a></li>
                @else
                <li class="nav-item"><a class="nav-link" href="{{app_url("market?tab=fruit")}}">@lang('translator.fruit')</a></li>
                @endif

                @if($_GET["tab"]=="meat")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("market?tab=meat")}}">@lang('translator.meat')</a></li>
                @else
                <li class="nav-item"><a class="nav-link"  href="{{app_url("market?tab=meat")}}">@lang('translator.meat')</a></li>
                @endif

                @if($_GET["tab"]=="fish")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("market?tab=fish")}}">@lang('translator.fish')</a></li>
                @else
                <li class="nav-item"><a class="nav-link" href="{{app_url("market?tab=fish")}}">@lang('translator.fish')</a></li>
                @endif


            </ul>
            @if($_GET["tab"]=="all")
                @if(App::getLocale()=='kh')

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
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/watermelon_PNG2661.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>ផ្លែឈើ</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">ផ្លែឪឡឹក</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/278_product_image_50608.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p>ត្រី</p>

                                        </div>
                                        <div class="col-md-7">
                                            <p class="price">ត្រីក្រាញ់</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/8.png" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>បន្លែ</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">ផ្លែត្រប់</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/466_product_image_37581.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p>ត្រី</p>

                                        </div>
                                        <div class="col-md-7">
                                            <p class="price">ត្រីអណ្តែង</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/Beef-Meat-PNG-File.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>សាច់</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">សាច់គោ</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/4.png" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>បន្លែ</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">ដំឡូងបារាំង</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/2.png" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p>បន្លែ</p>

                                        </div>
                                        <div class="col-md-7">
                                            <p class="price">ផ្កាខាត់ណាខៀវ</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/apple.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>ផ្លែឈើ</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">ផ្លែប៉ោម</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/strawberry-juice-png-5.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>ផ្លែឈើ</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">ផ្លែស្តបូរី</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                @elseif(App::getLocale()=='en')
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
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/watermelon_PNG2661.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Fruit</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">Watermelon</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/278_product_image_50608.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p>Fish</p>

                                        </div>
                                        <div class="col-md-7">
                                            <p class="price">Anabas Testudineus</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/8.png" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Vegetable</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">Eggplant</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/466_product_image_37581.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p>Fish</p>

                                        </div>
                                        <div class="col-md-7">
                                            <p class="price">Claria Macrocephalus</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/Beef-Meat-PNG-File.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Meat</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">Beef</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/4.png" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Vegetable</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">Potato</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/2.png" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Vegetable</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">Broccoli</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/apple.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Fruit</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">Apple</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="product-thumb">
                                <div class="image">
                                    <a href="#"><img src="{{url('images/strawberry-juice-png-5.png')}}" alt="image" title="image" class="img-responsive"></a>
                                </div>
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Fruit</p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="price">Strawberry</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            @elseif($_GET["tab"]=="vegetable")
                @if(App::getLocale()=='kh')

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
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/8.png" alt="image" title="image" class="img-responsive"></a>
                            </div>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>បន្លែ</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="price">ផ្លែត្រប់</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/4.png" alt="image" title="image" class="img-responsive"></a>
                            </div>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>បន្លែ</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="price">ដំឡូងបារាំង</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/2.png" alt="image" title="image" class="img-responsive"></a>
                            </div>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p>បន្លែ</p>

                                    </div>
                                    <div class="col-md-7">
                                        <p class="price">ផ្កាខាត់ណាខៀវ</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                @elseif(App::getLocale()=='en')
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
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/8.png" alt="image" title="image" class="img-responsive"></a>
                            </div>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Vegetable</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="price">Eggplant</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/4.png" alt="image" title="image" class="img-responsive"></a>
                            </div>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Vegetable</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="price">Potato</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/product/2.png" alt="image" title="image" class="img-responsive"></a>
                            </div>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Vegetable</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="price">Broccoli</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                @endif
            @elseif($_GET["tab"]=="fruit")
            @if(App::getLocale()=='kh')

            <div class="row">

                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/watermelon_PNG2661.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>ផ្លែឈើ</p>

                                </div>
                                <div class="col-md-6">
                                    <p class="price">ផ្លែឪឡឹក</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/apple.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>ផ្លែឈើ</p>

                                </div>
                                <div class="col-md-6">
                                    <p class="price">ផ្លែប៉ោម</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/strawberry-juice-png-5.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>ផ្លែឈើ</p>

                                </div>
                                <div class="col-md-6">
                                    <p class="price">ផ្លែស្តបូរី</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            @elseif(App::getLocale()=='en')
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/watermelon_PNG2661.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Fruit</p>

                                </div>
                                <div class="col-md-6">
                                    <p class="price">Watermelon</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/apple.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Fruit</p>

                                </div>
                                <div class="col-md-6">
                                    <p class="price">Apple</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/strawberry-juice-png-5.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Fruit</p>

                                </div>
                                <div class="col-md-6">
                                    <p class="price">Strawberry</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            @endif
            @elseif($_GET["tab"]=="meat")
                @if(App::getLocale()=='kh')

                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="#"><img src="{{url('images/Beef-Meat-PNG-File.png')}}" alt="image" title="image" class="img-responsive"></a>
                            </div>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>សាច់</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="price">សាច់គោ</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                @elseif(App::getLocale()=='en')
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="product-thumb">
                            <div class="image">
                                <a href="#"><img src="{{url('images/Beef-Meat-PNG-File.png')}}" alt="image" title="image" class="img-responsive"></a>
                            </div>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Meat</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="price">Beef</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                @endif
            @elseif($_GET["tab"]=="fish")
            @if(App::getLocale()=='kh')

            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/278_product_image_50608.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>ត្រី</p>

                                </div>
                                <div class="col-md-7">
                                    <p class="price">ត្រីក្រាញ់</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/466_product_image_37581.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>ត្រី</p>

                                </div>
                                <div class="col-md-7">
                                    <p class="price">ត្រីអណ្តែង</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            @elseif(App::getLocale()=='en')
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/278_product_image_50608.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>Fish</p>

                                </div>
                                <div class="col-md-7">
                                    <p class="price">Anabas Testudineus</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image">
                            <a href="#"><img src="{{url('images/466_product_image_37581.png')}}" alt="image" title="image" class="img-responsive"></a>
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>Fish</p>

                                </div>
                                <div class="col-md-7">
                                    <p class="price">Claria Macrocephalus</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            @endif
            @else

            @endif


        </section>
    </div>
</div>
@endsection

@section('product-js')

@endsection