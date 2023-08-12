@extends('layouts.app')

@section('page-title', __('Create page category'))
@section('page-heading', __('Manage page'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('page-category.index') }}" class="text-muted">
            @lang('Post category')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Create page category')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <form action="{{route("page-category.store")}}" method="POST" id="page-category-form">
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
            <label for="order">@lang('Description')</label>
            <textarea class="form-control" id="description" name="description" rows="4">
                {{old("description")}}
            </textarea>
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
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Post\PostCategory\CreatePostCategoryRequest','#page-category-form') !!}
@stop
