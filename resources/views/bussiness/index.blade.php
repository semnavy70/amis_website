@extends('master')

<title>@lang('translator.sms_service')</title>
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

</style>
@endsection
@section('content')
@php
if(!isset($_GET["tab"])){
    $_GET["tab"] = "farmer";
}
$agri_office = \App\Post::where('category_id', getCatbySlug('agricultural-marketing-office', true))->where('status', 'published')->orderBy('id', 'asc')->get();
$agri_info = \App\Post::where('category_id', getCatbySlug('agricultural-marketing-information', true))->where('status', 'published')->orderBy('id', 'asc')->get();
@endphp
<div class="content-page">
    <div class="inner-intro bussiness-bg">
        <div class="container">
            <div class="title">

                <h1>@lang('translator.sms_service')</h1>

            </div>
        </div>
    </div>
    <div class="container">
    <ol class="breadcrumb hidden-xs">
        <li class="breadcrumb-item completed"><a href="{{app_url('/')}}">@lang('translator.home')</a></li>
        <li class="breadcrumb-item active"><a href="#">@lang('translator.sms_service')</a></li>
    </ol>
    <section class="detail">
        <ul class="nav nav-tabs">
            @if($_GET["tab"]=="farmer")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("bussiness?tab=farmer")}}">@lang('translator.farmer')</a></li>
            @else
                <li  class="nav-item"><a class="nav-link" href="{{app_url("bussiness?tab=farmer")}}">@lang('translator.farmer')</a></li>
            @endif

            @if($_GET["tab"]=="trander")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("bussiness?tab=trander")}}">@lang('translator.trander')</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{app_url("bussiness?tab=trander")}}">@lang('translator.trander')</a></li>
            @endif

            @if($_GET["tab"]=="sme")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("bussiness?tab=sme")}}">@lang('translator.sme')</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{app_url("bussiness?tab=sme")}}">@lang('translator.sme')</a></li>
            @endif

            @if($_GET["tab"]=="cooperative")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("bussiness?tab=cooperative")}}">@lang('translator.cooperative')</a></li>
            @else
                <li class="nav-item"><a class="nav-link"  href="{{app_url("bussiness?tab=cooperative")}}">@lang('translator.cooperative')</a></li>
            @endif

            @if($_GET["tab"]=="company")
                <li class="nav-item"><a class="nav-link active" href="{{app_url("bussiness?tab=company")}}">@lang('translator.company')</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{app_url("bussiness?tab=company")}}">@lang('translator.company')</a></li>
            @endif


        </ul>
        @if($_GET["tab"]=="farmer")
            <table id="table_id" class="table table-striped ">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        @elseif($_GET["tab"]=="trander")
            <table id="table_id" class="table table-striped ">
            <thead>
            <tr>
                <th>@lang('translator.no')</th>
                <th>@lang('translator.fullname')</th>
                <th>@lang('translator.position')</th>
                <th>@lang('translator.organization')</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>ម៉េង ស៊ន</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>2</td>
                <td>នូ  ស្រី</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>3</td>
                <td>ឈាន យ៉ុន</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>4</td>
                <td>ឡេង ធារិទ្ធិ</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>5</td>
                <td>ហែល ម៉ាយូរ៉ា</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>6</td>
                <td>លន់  ​កុម្ភៈ</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>7</td>
                <td>នូ  សារិទ្ធិ</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>8</td>
                <td>អ៊ូ  អីម</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>9</td>
                <td>ហែល វណ្ណី</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            <tr>
                <td>10</td>
                <td>ម៉េត​ ​កន្និកា</td>
                <td>អាជីវករ</td>
                <td>ផ្សារ លើ</td>
            </tr>
            </tbody>
        </table>
        @elseif($_GET["tab"]=="sme")
            <table id="table_id" class="table table-striped ">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        @elseif($_GET["tab"]=="cooperative")
        <table id="table_id" class="table table-striped ">
            <thead>
            <tr>
                <th>@lang('translator.no')</th>
                <th>@lang('translator.place')</th>
                <th>@lang('translator.address')</th>
                <th>@lang('translator.tel')</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Kaksikam Damnam Sereyreang Kompong Cham</td>
                <td>Kampong Cham</td>
                <td>012 504 062</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Kaksikar Mean Chey</td>
                <td>Kampong Cham</td>
                <td>097 9 867 263</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Kvet Thom Rikchamreum</td>
                <td>Kampong Cham</td>
                <td>099 673 883</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Bramyam Roungroeung</td>
                <td>Kampong Cham</td>
                <td>011 828 261</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Sambor Mean Chey</td>
                <td>Kampong Cham</td>
                <td>077 996 768</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Somroang Brem Brey</td>
                <td>Kampong Cham</td>
                <td>097 2 700 499</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Stoengtrong Sen Chey</td>
                <td>Kampong Cham</td>
                <td>012 768 156</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Toul Presh Vihear</td>
                <td>Kampong Cham</td>
                <td>089 412 149</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Trotrong Kaksikar</td>
                <td>Kampong Cham</td>
                <td>077 294 446</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Treung Samaki Mean Chey</td>
                <td>Kampong Cham</td>
                <td>070 938 268</td>
            </tr>
            </tbody>
        </table>
        @elseif($_GET["tab"]=="company")
            <table id="table_id" class="table table-striped ">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        @else

        @endif


    </section>
</div>
</div>
@endsection

@section('product-js')

@endsection