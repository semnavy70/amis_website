@extends('layouts.app')

@section('page-title', __('Update'))
@section('page-heading', __('Manage Menus'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('menus.index') }}" class="text-muted">
            @lang('Manage Menus')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Manage Menus')
    </li>
@stop
@section('content')
    @include('partials.messages')
    <div class="create-post">
        <form action="{{ route('menus.update') }}" method="POST" id="post-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $menus->id }}">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">@lang('Name*')</label>
                        <input name="name" type="text" class="form-control" id="name"
                               value="{{ old('name') ?? $menus->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">@lang('Create New')</button>
                </div>
            </div>
        </form>
    </div>
@stop
