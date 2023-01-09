@extends('master')

@section('site-title', $page->title)

@section('content')
@php $page = $page->translate(App::getLocale()); @endphp
	<div class="content-page">
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
						<div class="mb-5 ">
							{!! $page->body !!}
						</div>
					</div>
					{{-- Page sidebar --}}
					<div class="col-md-4">
						<div class="page-sidebar sidebar">
							<div class="related">
								<h5>@lang('translator.related')</h5>
								<div class="line">
								</div>
								<div class="list-group">
									@if($page->slug == 'about-us')
										@foreach($agri_office as $item)
										@php $item = $item->translate(App::getLocale()); @endphp
										<a href="{{ getLink($item) }}" class="list-group-item list-group-item-action">
											<span class="mr-1"><i class="fas fa-angle-double-right"></i></span> {{ $item->title }}
										</a>
										@endforeach
									@else
										@foreach($relate as $item)
										@php $item = $item->translate(App::getLocale()); @endphp
										<a href="{{ app_url('page/'.$item->slug) }}" class="list-group-item list-group-item-action">
											<span class="mr-1"><i class="fas fa-angle-double-right"></i></span> {{ $item->title }}
										</a>
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    {{Counter::count('')}}

@stop
