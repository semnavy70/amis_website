@extends('master')
@section('site-title', 'Search Result')
@section('content')

    <div class="inner-intro news-bg">
        <div class="container">
            <div class="title">
                <h1><strong class="text-primary">{{$post->total()}}</strong> @lang('translator.search_result') "<strong class="text-primary">{{$query}}</strong>"</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <section class="page-news">
            <div class="content-news">
                <div class="row">
                    @if(count($post)==0)
                        <h1 class="text-white">@lang('translator.not_found')</h1>
                    @else
                    @foreach($post as $item)
                        @php $item = $item->translate(App::getLocale()); @endphp
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card">
                                @if($item->image == "")
                                    <img class="card-img-top rounded-0" src="{{ url('assets/img/no-photo.png') }}" class="img-fluid" alt="">
                                @else
                                    <img class="card-img-top rounded-0" src="{{ gcpUrl($item->image) }}" class="img-fluid" alt="">
                                @endif
                                <div class="card-body">
                                    <h6>{{ shorttitleBox($item->title) }}</h6>
                                    <div class="line"></div>
                                    <p class="meta" style="font-size: 13px; padding-top: 5px;">
										<span>
											<i class="fas fa-user"></i>
										</span>
                                        ​ {{ $item->author->name }}​​ | {{ daykhmer($item->created_at) }}
                                    </p>
                                    <p>{{ shorttitleBox($item->excerpt) }}</p>

                                    <a href="{{ getLink($item) }}">@lang('translator.read_more')
                                        <span>
										<i class="fas fa-angle-double-right"></i>
									</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $post->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop