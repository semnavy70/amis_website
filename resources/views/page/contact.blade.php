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
                        <h2>@lang('translator.inquiry_form')</h2>
                        @if (session('status'))
                            <div class="alert alert-success" id="message">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('page.storeContact') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row"><label class="col-sm-2 col-form-label" for="inputPassword">@lang('translator.sub_name')</label>
                            <div class="col-sm-10"><input id="name" name="name" type="text" class="form-control" style="font-family: hanuman;" required="" placeholder="@lang('translator.sub_name')" /></div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label" for="email">@lang('translator.sub_email')</label>
                            <div class="col-sm-10"><input id="email" name="email" type="email" class="form-control" style="font-family: hanuman;" required="" placeholder="@lang('translator.sub_email')" /></div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label" for="inputPassword">@lang('translator.message')</label>
                            <div class="col-sm-10"><textarea id="message" name="message" type="text" class="form-control" style="font-family: hanuman;" rows="5" required="" placeholder="@lang('translator.message')"></textarea></div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label" for="email">@lang('translator.site_lang')</label>
                            <div class="col-sm-10"><input id="site_lang" name="site_lang" type="number" class="form-control" style="font-family: hanuman;" required="" placeholder="@lang('translator.site_lang')" /></div>
                            </div>
                            <button class="btn btn-light pull-right" style="font-family: Hanuman;" type="submit">@lang('translator.sub_send')</button>
                        </form>
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
