@extends('layouts.app')

@section('page-title', __('Create post status'))
@section('page-heading', __('Manage post'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('post-status.index') }}" class="text-muted">
            @lang('Post status')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Create post status')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <form action="{{ route('post-status.store') }}" method="POST" id="post-status-form">
        @csrf
        <div class="form-group">
            <label for="name">@lang('Name*')</label>
            <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="slug">@lang('Slug*')</label>
            <input name="slug" type="text" class="form-control" id="slug" value="{{ old('slug') }}">
        </div>
        <div class="form-group">
            <label for="order">@lang('Order*')</label>
            <input name="order" type="number" class="form-control" id="order"
                   value="{{ old('order') ?? $incrementOrder }}">
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
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Post\PostStatus\CreatePostStatusRequest','#post-status-form') !!}
@stop
