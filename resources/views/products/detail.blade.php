@extends('master')

@section('site-title', 'Product Detail')
@section('product-css')
<!-- crousel css -->
{{-- <link href="https://ocsolutions.co.in/html/organic_food/js/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"> --}}
<!--bootstrap select-->
<link href="https://ocsolutions.co.in/html/organic_food/js/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
<!-- font -->
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,600,700,800,900" rel="stylesheet">
<!-- font-awesome -->
<link href="https://ocsolutions.co.in/html/organic_food/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://ocsolutions.co.in/html/organic_food/css/ele-style.css" rel="stylesheet" type="text/css">
<!-- stylesheet -->
<link href="https://ocsolutions.co.in/html/organic_food/css/style.css" rel="stylesheet" type="text/css">

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

</style>
@endsection

@section('content')
@php
    $agri_office = \App\Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
    $agri_info = \App\Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();
@endphp
    <div class="container">
        <ol class="breadcrumb hidden-xs">
            <li class="breadcrumb-item completed"><a href="{{app_url('/')}}">@lang('translator.home')</a></li>
            <li class="breadcrumb-item active"><a href="#">Product Detail</a></li>
        </ol>
        <section class="detail">
            <div class="row">
            <!--thumb image code start-->
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                <a class="thumbnail" href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/big_product.png" title="img" alt="img"></a>
                <ul class="thumbnails list-inline">
                    <li class="image-additional">
                        <a class="thumbnail" href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/small_product1.png" title="img" alt="img"></a>
                    </li>
                    <li class="image-additional">
                        <a class="thumbnail" href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/small_product2.png" title="img" alt="img"></a>
                    </li>
                    <li class="image-additional">
                        <a class="thumbnail" href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/small_product3.png" title="img" alt="img"></a>
                    </li>
                    <li class="image-additional">
                        <a class="thumbnail" href="#"><img src="https://ocsolutions.co.in/html/organic_food/images/small_product1.png" title="img" alt="img"></a>
                    </li>
                </ul>
            </div>
            <!--thumb image code end-->
        
            <!--Product detail code start-->
            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
                <h5>Organic <span>Onion</span></h5>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <p class="shortdes">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed doeiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enimad minim veniam, quis nostrud exercitation ullamco laboris nisi utaliquip ex ea commodo consequat. Duis aute irure dolor inreprehenderit in voluptate velit esse cillum dolor.
                </p>
                <hr>
                <h5>Product Features</h5>
                <ul class="list-unstyled featured">
                    <li><i class="icon_box-checked"></i> 100% Fresh not Chemicals</li>
                    <li><i class="icon_box-checked"></i> 100% Organic food</li>
                    <li><i class="icon_box-checked"></i> 100% Fresh Food from farm</li>
                </ul>
                <hr>
                <div class="price">
                    $55.00
                </div>
                <hr>
                
            </div>
        </section>
    </div>

@endsection

@section('product-js')
<!-- jquery -->
<script src="https://ocsolutions.co.in/html/organic_food/js/jquery.2.1.1.min.js"></script>
<!-- bootstrap js -->
<script src="https://ocsolutions.co.in/html/organic_food/bootstrap/js/bootstrap.min.js"></script>
<!--bootstrap select-->
<script src="https://ocsolutions.co.in/html/organic_food/js/dist/js/bootstrap-select.js"></script>
<!--internal js-->
<script src="https://ocsolutions.co.in/html/organic_food/js/internal.js"></script>
<!-- owlcarousel js -->
<script src="https://ocsolutions.co.in/html/organic_food/js/owl-carousel/owl.carousel.min.js"></script>
@endsection