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
                            @if (session('status'))
                                <div class="alert alert-success" id="message">
                                    {{ session('status') }}
                                </div>
							@endif
							@php
								$type = \App\SubscriberType::all();
							@endphp
                            <form action="{{ route('page.storeSubscriber') }}" method="post">
								{{ csrf_field() }}
								<div class="form-group row"><label class="col-sm-2 col-form-label" for="inputPassword">@lang('translator.sub_type')</label>
                                    <div class="col-sm-10"><select id="sub_type" required name="sub_type" class="selectpicker show-tick form-control" data-live-search="false">
										@foreach($type as $item)
										  <option value="{{ $item->id }}">{{ $item->name }}</option>
										@endforeach
									  </select>
									</div>
                                </div>
                                <div class="form-group row"><label class="col-sm-2 col-form-label" for="inputPassword">@lang('translator.sub_name')</label>
                                    <div class="col-sm-10"><input id="name" name="name" type="text" class="form-control" style="font-family: hanuman;" required="" placeholder="@lang('translator.sub_name')" /></div>
                                </div>
                                <div class="form-group row"><label class="col-sm-2 col-form-label" for="inputPassword">@lang('translator.sub_phone')</label>
                                    <div class="col-sm-10"><input id="phone" name="phone" type="text" class="form-control" style="font-family: hanuman;" required="" placeholder="@lang('translator.sub_phone')" /></div>
                                </div>
                                <div class="form-group row"><label class="col-sm-2 col-form-label" for="email">@lang('translator.sub_email')</label>
                                    <div class="col-sm-10"><input id="email" name="email" type="email" class="form-control" style="font-family: hanuman;" required="" placeholder="@lang('translator.sub_email')" /></div>
								</div>
								<div class="form-group row"><label class="col-sm-2 col-form-label" for="address">@lang('translator.sub_address')</label>
                                    <div class="col-sm-10"><textarea id="address" name="address" type="text" class="form-control" style="font-family: hanuman;" rows="5" required="" placeholder="@lang('translator.sub_address')"></textarea></div>
                                </div>
                                <button class="btn btn-light pull-right" style="font-family: Hanuman;" type="submit">@lang('translator.sub_send')</button>
                            </form>
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

@section('alert')

    <script>
        //When the page has loaded.
        $( document ).ready(function(){
            $('#message').fadeIn('slow', function(){
               $('#message').delay(5000).fadeOut(); 
            });
        });
    </script>

@endsection