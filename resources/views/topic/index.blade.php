@extends('master')

@section('site-title', $title)
@section('content')
	{{-- <style>
		.page-link{
			color: #707a1b;
		}
		.page-item.active .page-link {
			z-index: 1;
			color: #fff;
			background-color: #707a1b;
			border-color: #707a1b;
		}
	</style> --}}
	<div class="inner-intro event-bg">
		<div class="container">
			<div class="title">
				@php $category = $category->translate(App::getLocale()); @endphp
				<h1>{{ $category->name }}</h1>
			</div>
		</div>
	</div>
	<div class="container">
		{!! Breadcrumbs::render('topic', $category) !!}
		<section class="page-news">
			<div class="content-news inside">
				<div class="row">
					@foreach($list_news as $item)
					@php $item = $item->translate(App::getLocale()); @endphp
					<div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
						<div class="card">
							<div class="card-img position-relative">
							@if($item->image == "")
								<img class="card-img-top rounded-0" src="{{ url('assets/img/no-photo.png') }}" style="min-height: 233px;object-fit: cover;" class="img-fluid" alt="">
							@else
								<img class="card-img-top rounded-0" src="{{ gcpUrl($item->image) }}" style="min-height: 233px;object-fit: cover;" class="img-fluid" alt="">
                                @if($item->category_id==22 || $item->category_id==1)
								<div class="video-icon">
								<i class="fab fa-youtube fa-3x shadow"><div class="bgicon" style="height: 20px;width: 20px;background-color: #fff;margin-top: -34px;margin-left: 17px;"></div></i></div>
                                @endif
							@endif
							</div>
							<div class="card-body">
								<h6>{{ $item->title }}</h6>
								<div class="line"></div>
								<p class="meta" style="font-size: 13px; padding-top: 5px;">
										<span>
											<i class="fas fa-user"></i>
										</span>
									​ {{ $item->author->name }}​​ | {{ daykhmer($item->created_at) }}
								</p>
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
				<div class="row">
					<div class="col-12">
						{{ $list_news->links() }}
					</div>
				</div>
			</div>
		</section>
	</div>
	{{Counter::count('')}}

@endsection


