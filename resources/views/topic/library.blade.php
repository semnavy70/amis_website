@extends('master')
@section('site-title',$title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {!! Breadcrumbs::render('topic', $category) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-xs-12 list-media">
            @foreach($list_news as $item)
                <div class="col-md-6">
                    <img src="{{gcpUrl($item->image)}}" alt="" class="media-img" onclick="">
                    <a href="{{ app_url('article/'.$item->id)}}">
                        <h5 class="title">
                            {{$item->title}}
                        </h5>
                    </a>
                    <div class="content-info">
                    <span class="date">
                            <i class="fa fa-md fa-fw fa-calendar"></i>
                            {{daykhmer($item->created_at)}} 
                        </span>
                    </div> <!-- / Content info -->
                </div> <!-- / col 6 -->
            @endforeach
            <!-- <div class="col-md-6 col-xs-6">
                <img src="img/909.jpeg" alt="" class="media-img">
                <a href="javascript:void(0)">
                    <h5 class="title">
                        ឯកឧត្តម ត្រាំ អុីវតឹក ​​អញ្ជើញ​​ក្នុង​​ពិធី​ប្រគល់​ពាន​រង្វាន់​បច្ចេក​វិទ្យា​គមនាគមន៍​ ​និង​ព័ត៌​មាន​កម្ពុជា​​ឆ្នាំ​​២០១៧​​ នៅ​ទីស្ដី​ការ​​ក្រសួង​ប្រៃ​សណីយ៍​​ និង​ទូរ​គមនាគមន៍
                    </h5>
                </a>
                <div class="content-info">
                <span class="date">
                    <i class="fa fa-md fa-fw fa-calendar"></i>ថ្ងៃ ព្រហស្បតិ៍ ទី ០២ ខែ មេសា ឆ្នាំ ២០១៥ </span>
                </div>
            </div> -->
        
    </div>
    <!-- <div class='row'>
        <div class="col-md-12">
            <center>
            {{ $list_news->links() }}  
            </center>
        </div>
    </div>   -->
    @include('partials.sidebar')
    </div>
</div>
@stop

@section('script')

    <script type="text/javascript">
        var declare_select = $("#declare-select");
       
        declare_select.change(function(){
            var filter_url = '{{app_url("topic/declaration")}}/' + $(this).val();
            window.location = filter_url;
        });    
    </script>

@stop