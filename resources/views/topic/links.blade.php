@extends('master')

@section('site-title','Other Link')

@section('content')

    <div class="container">
        @php $l = $links->translate(App::getLocale()); @endphp
        <section class="detail">
            <div class="row">
                <div class="col-md-9">
                    <ul>
                        @foreach($l as $item)
                            <li>{{$item->title}} <a title="{{$item->title}}" href="{{$item->link}}">{{$item->link}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @include('partials.sidebar')
            </div>
        </section>
    </div>


@endsection

@section('script')

    <script type="text/javascript">

        $(document).ready(function(){
            var text="{{app_url($active) }}";
            $(".menu_active > li").each(function() {
                if($(this).children().attr('href')==text)
                {
                    $(this).addClass('active');
                }
            });

        });

    </script>

@stop