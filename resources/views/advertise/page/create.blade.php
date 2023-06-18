@extends('layouts.app')

@section('page-title', __('Create page'))
@section('page-heading', __('Manage advertise'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('advertise-page.index') }}" class="text-muted">
            @lang('Page')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Create page')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <form action="{{route("advertise-page.store")}}" method="POST" id="advertise-page-form">
        @csrf
        <div class="form-group">
            <label for="name">@lang('Name*')</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old("name")}}">
        </div>
        <div class="form-group">
            <label for="slug">@lang('Slug*')</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{old("slug")}}">
        </div>
        <div class="form-group">
            <label for="order">@lang('Order')</label>
            <input type="number" class="form-control" id="order" name="order"
                   value="{{old("order") ?? $incrementOrder }}">
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
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Advertise\AdvertisePage\UpdateAdvertisePageRequest','#advertise-page-form') !!}
@stop
