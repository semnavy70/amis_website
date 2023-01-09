@extends('master')

@section('site-title',$post->title)

@section('content')

    <div class="container">
        @php $post = $post->translate(App::getLocale()); @endphp
        {!! Breadcrumbs::render('article', $post) !!}
        <section class="detail">
            <div class="row">
            <div class="col-md-9">
                <h2 class="detail-title">{{ $post->title }}</h2>
                <hr>
                <p>{!! $post->body !!}</p>
                <p class="detail-meta" style="font-size: 13px; padding-top: 5px;">
                            <span>
                                <i class="fas fa-user"></i>
                            </span>
                    ​ {{ $post->author->name }}​​ | {{ daykhmer($post->created_at) }}
                </p>
            </div>
                @include('partials.sidebar')
            </div>
        </section>
    </div>
    {{Counter::count('')}}

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