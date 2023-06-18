@extends('layouts.app')

@section('page-title', __('Edit advertise blog'))
@section('page-heading', __('Manage advertise'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('advertise-blog.index') }}" class="text-muted">
            @lang('Advertise blog')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Edit advertise blog')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <form action="{{route("advertise-blog.update")}}" method="POST" id="advertise-blog-form">
        @csrf
        <input type="hidden" name="id" value="{{$advertiseBlog->id}}">
        <div class="form-group">
            <label for="name">@lang('Name*')</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old("name")??$advertiseBlog->name}}">
        </div>
        <div class="form-group">
            <label for="slug">@lang('Slug*')</label>
            <input type="text" class="form-control" id="slug" name="slug" disabled
                   value="{{old("slug")??$advertiseBlog->slug}}">
        </div>
        <div class="form-group">
            <label for="order">@lang('Order')</label>
            <input type="number" class="form-control" id="order" name="order"
                   value="{{old("order")??$advertiseBlog->order}}">
        </div>
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100">@lang('Save')</button>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Advertise\AdvertiseBlog\UpdateAdvertiseBlogRequest','#advertise-blog-form') !!}
@stop
