@extends('master')

@section('site-title', "Pricing Data")

@section('content')

    {{--@include('share.slide',['slide_show' => $slide_show])--}}
    <div class="content-page">
        @php $page = $page->translate(App::getLocale()); @endphp
        <div class="inner-intro news-bg">
            <div class="container">
                <div class="title">
                    <h1>{{ $page->title }}</h1>
                </div>
            </div>
        </div>    
        
        <div class="container">
            {!! Breadcrumbs::render('page', $page) !!}
            <div class="page-body">
                <div class="row">
                    <div class="col-md-8">
                            {!! $page->body !!}
                    </div>
                    <div class="col-md-4">
                        <div class="page-sidebar sidebar">
                            <div class="related">
                                <h5>@lang('translator.related')</h5>
                                <div class="line">
                                </div>
                                <div class="list-group">
                                    @foreach($relate as $item)
                                    @php $item = $item->translate(App::getLocale()); @endphp
                                    <a href="{{ url('page/'.$item->slug) }}" class="list-group-item list-group-item-action">
                                        <span class="mr-1"><i class="fas fa-angle-double-right"></i></span> {{ $item->title }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="content bg-grey-a200">
                            <form action="" method="POST" enctype="multipart/form-data" class="form-inline home-chart-options">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    @if(App::getLocale()=='kh')
                                    <select class="custom-select my-1 mr-sm-2" name="category" id="Category" data-url="{{ url('api/marketapp/commodities-categories') }}" data-locale="2"> </select>
                                    @elseif(App::getLocale()=='en')
                                        <select class="custom-select my-1 mr-sm-2" name="category" id="Category" data-url="{{ url('api/marketapp/commodities-categories') }}" data-locale="1"> </select>
                                    @endif
                                    <label for="commodity">Product</label>
        
                                    @if(App::getLocale()=='kh')
                                        <select class="custom-select my-1 mr-sm-2" name="commodity" id="Commodity" data-url="{{ url('api/marketapp/category-commodities') }}" data-locale="2"></select>
                                    @elseif(App::getLocale()=='en')
                                        <select class="custom-select my-1 mr-sm-2" name="commodity" id="Commodity" data-url="{{ url('api/marketapp/category-commodities') }}" data-locale="1"></select>
                                    @endif
        
                                    <label for="usertype">Price Data From</label>
        
                                    <div class="checkbox">
                                        <label><input id="AMOUserType" type="checkbox" value="1" checked="checked">AMO Collectors</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input id="TraderUserType" type="checkbox" value="2">Traders using SMS System</label>
                                    </div>
                                    <div class="alert alert-danger" id="UserTypeError" style="display: none;">
                                        <span>Please select at least one user type</span>
                                    </div>
        
                                </div>
                            </form>
                            <br>
                            <ul class="nav nav-tabs nav-pills nav-graph-types">
                                <li  class="nav-item">
                                    <a class="nav-link" href="#" data-url="{{ url('api/marketapp/market-commodity-prices') }}">
                                        (English) View All Markets
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-url="{{ url('api/marketapp/province-commodity-prices')}}">
                                        (English) View All Provinces							</a>
                                </li>
                            </ul>
                            @if(App::getLocale()=='kh')                    
                            <div id="PriceChartContainer" data-url="{{ url('api/marketapp/market-commodity-prices')}}" data-locale="2">
                            @elseif(App::getLocale()=='en')
                            <div id="PriceChartContainer" data-url="{{ url('api/marketapp/market-commodity-prices')}}" data-locale="1">   
                            @endif                                         
                                <div id="high-chart" series="[]" data-highcharts-chart="3"></div>
                                <div id="PriceDataTable" data-start="0">
                                    <table class="table table-hover">
                                        <thead class="thead-inverse">
                                        <tr><th>@lang('translator.market')</th>
                                            <th>@lang('translator.date')</th>
                                            <th>@lang('translator.price')</th>
                                        </tr></thead>
                                        <tbody>
                                            {{-- <tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2016-03-30</td><td>445 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2016-03-25</td><td>445 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2016-03-16</td><td>445 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2016-02-10</td><td>465 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2015-12-28</td><td>480 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2015-09-11</td><td>535 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2015-09-02</td><td>535 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2015-08-21</td><td>490 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2015-07-31</td><td>475 riel</td></tr><tr><td>ផ្សារអន្តរជាតិ (A)</td><td>2015-07-24</td><td>475 riel</td></tr> --}}
                                        </tbody>
                                    </table>
                                    <a href="#" onclick="MarketPriceLoader.loadPreviousDataTable(); return false;" class="pull-left" id="PriceDataTablePrevious" style="display: none;">
                                        <i class="fas fa-angle-double-left"></i> @lang('translator.prev')</a>
                                    <a href="#" onclick="MarketPriceLoader.loadNextDataTable(); return false;" class="pull-right" id="PriceDataTableNext">
                                        @lang('translator.next') <i class="fas fa-angle-double-right"></i></a>
                                </div>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{Counter::count('')}}

@endsection
@section('chart-js')

    <script>
        var serial = "WP";
    </script>
    <script src="{{ url('assets/js/highcharts.js')}}"></script>
    <script src="https://code.highcharts.com/modules/boost.js"></script>
    <script src="{{ url('assets/js/exporting.js')}}"></script>
    <script src="{{ url('assets/js/prices-fluctuation.js') }}"></script>


@endsection
