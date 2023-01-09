@extends('master')

@section('site-title', $doc_type->name)

@section('content')
{{-- @php $page = $page->translate(App::getLocale()); @endphp --}}
@php $doc_type = $doc_type->translate(App::getLocale()); @endphp
	<div class="content-page">
		<div class="inner-intro document-bg">
			<div class="container">
				<div class="title">
					{{-- @foreach($doc_type as $index => $item) --}}
					<h1>{{ $doc_type->name }}</h1>
					{{-- @endforeach --}}
				</div>
			</div>
		</div>
		<div class="container">
			{{-- {!! Breadcrumbs::render('document', $doc_type) !!} --}}

			<ol class="breadcrumb hidden-xs">
				<li class="breadcrumb-item completed"><a href="{{app_url('/')}}">@lang('translator.home')</a></li>
				<li class="breadcrumb-item active"><a href="{{ url('document/'.$doc_type->slug) }}">{{ $doc_type->name }}</a></li>
			</ol>
			<div class="page-body">
				<div class="row">
					<div class="col-md-8">
						<div class="mb-5 ">

                            {!! $doc_type->description !!}
                            
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width:20%;">@lang('translator.date')</th>
                                        <th colspan="2">@lang('translator.title')</th>
                                    </tr>
                                    @foreach($document as $item)
                                    <tr>
										<td>{{daykhmerLibrary($item->created_at)}}</td>
										@if($doc_type->id != 2)
										<td><a href="{{gcpUrl(getFileLink($item->pdf))}}" download="" target="_blank">{{shorttitle($item->title)}}</a></td>
										@else
										<td><a href="{{ $item->video_link }}" target="_blank">{{shorttitle($item->title)}}</a></td>
										@endif
										@if($doc_type->id != 2)
										<td><a class="btn btn-primary pull-right" href="{{gcpUrl(getFileLink($item->pdf))}}" download="">&nbsp;@lang('translator.download')</a></td>
										@endif
                                    </tr>
                                    @endforeach                           
                                </tbody>
                            </table>
						</div>
					</div>
					{{-- Page sidebar --}}
					<div class="col-md-4">
						<div class="page-sidebar sidebar">
							<div class="related">
								<h5>@lang('translator.info_source')</h5>
								<div class="line">
								</div>
								<div class="list-group">
									@foreach($all_doc as $item)
										@if($item->id != $doc_type->id)
										@php $item = $item->translate(App::getLocale()); @endphp
										<a href="{{ app_url('document/'.$item->slug) }}" class="list-group-item list-group-item-action">
											<span class="mr-1"><i class="fas fa-angle-double-right"></i></span> {{ $item->name }}
										</a>
										@endif
									@endforeach
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
