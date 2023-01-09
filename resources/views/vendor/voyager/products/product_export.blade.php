@extends('master')
@section('site-title', 'Production')
@section('content')
    @php
        $agri_office = \App\Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
        $agri_info = \App\Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();
    @endphp

    <div class="content-page">
        <div class="inner-intro event-bg">
            <div class="container">
                <div class="title">

                    <h1>@lang('translator.productionexport')</h1>

                </div>
            </div>
        </div>
        <div class="container">
            <ol class="breadcrumb hidden-xs">
                <li class="breadcrumb-item completed"><a href="{{app_url('/')}}">@lang('translator.home')</a></li>
                <li class="breadcrumb-item active"><a href="#">@lang('translator.productionexport')</a></li>
            </ol>
            <section class="detail">

                <form action="{{route('voyager.products.map')}}" method="get" class="row">

                    <div class="col-4">
                        <div class="form-group">
                            <label for="product_export_id">@lang('translator.crop')</label>
                            <select class="form-control" name="product_export_id" id="product_export_id">
                                @foreach($products as $item)
                                    @if($item->id==$current["product_export_id"])
                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="start">@lang('translator.start')</label>
                            <select class="form-control" name="start" id="start">
                                @for($i=2014;$i<=2022;$i++)
                                    @if($current["start"]=="y$i")
                                        <option value="y{{$i}}" selected>{{$i}}</option>
                                    @else
                                        <option value="y{{$i}}">{{$i}}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="end">@lang('translator.end')</label>
                            <select class="form-control" name="end" id="end">
                                @for($i=2010;$i<=2022;$i++)
                                    @if($current["end"]=="y".$i)
                                        <option value="y{{$i}}" selected>{{$i}}</option>
                                    @else
                                        <option value="y{{$i}}">{{$i}}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                    </div>


                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="loader1" id="loader1"></div>
                        <div id="ProductionChartContainer" data-url="{{ route('voyager.products.getdataexport')}}" data-product_export_id="{{$current["product_export_id"]}}"   data-start="{{$current["start"]}}" data-end="{{$current["end"]}}" style="min-height: 450px; background-color: white;width: 100%; margin: 0 auto">
                            <div id="high-chart" series="[]" data-highcharts-chart="1">

                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>

@endsection
@section('chart-js')
    <script src="{{ url('assets/js/highcharts.js')}}"></script>
    <script src="https://code.highcharts.com/modules/boost.js"></script>
    <script src="{{ url('assets/js/exporting.js')}}?v=3"></script>
    <script src="{{ url('assets/js/productionexport.js?v=1') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.2.2/jquery.flexslider-min.js"></script>

@endsection
