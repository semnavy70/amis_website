@extends('layouts.app')

@section('page-title', __('Create'))
@section('page-heading', __('Manage Menus'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Create Menu Page')
    </li>
@stop
@section('content')
    @include('partials.messages')
    <div class="create-menus">
        <form action="{{ route('menus.store') }}" method="POST" id="post-form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">@lang('Name*')</label>
                        <input name="name" type="text" class="form-control" id="name"
                               value="{{ old('name') }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">@lang('Create New')</button>
                </div>
            </div>
        </form>
    </div>
@stop
