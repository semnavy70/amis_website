@extends('layouts.app')

@section('page-title', __('Edit post blog'))
@section('page-heading', __('Edit post blog'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('post-blog.index') }}" class="text-muted">
            @lang('Post blog')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Edit post blog')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <form action="{{ route('post-blog.update') }}" method="POST" id="post-blog-form">
        @csrf
        <input type="hidden" name="id" value="{{ $postBlog->id }}">
        <div class="form-group">
            <label for="name">@lang('Name*')</label>
            <input name="name" type="text" class="form-control" id="name" value="{{ old('name') ?? $postBlog->name }}">
        </div>
        <div class="form-group">
            <label for="slug">@lang('Slug*')</label>
            <input name="slug" type="text" class="form-control" id="slug" disabled
                   value="{{ old('slug') ?? $postBlog->slug }}">
        </div>
        <div class="form-group">
            <label for="order">@lang('Order*')</label>
            <input name="order" type="number" class="form-control" id="order"
                   value="{{ old('order') ?? $postBlog->order }}">
        </div>
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100">
                    @lang('Save')
                </button>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Post\PostBlog\UpdatePostBlogRequest','#post-blog-form') !!}
@stop

