@extends('layouts.app')

@section('page-title', __('Create'))
@section('page-heading', __('Manage MenuItems'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Create Menu Item')
    </li>
@stop
@section('content')
    @include('partials.messages')
    <div class="create-menus">
        <form action="{{ route('menuitem.store') }}" method="POST" id="post-form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="menu_id">@lang('Menus')</label>
                        <select name="menu_id" class="form-control" id="menu_id">
                            <option value="">--ជ្រើសរើស--</option>
                            @foreach($menus as $menuItem)
                                <option {{ old('menu_id') == $menuItem->id ? 'selected' : '' }} value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">@lang('Title*')</label>
                        <input name="title" type="text" class="form-control" id="title"
                               value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="url">@lang('Url')</label>
                        <input name="url" type="text" class="form-control" id="url"
                               value="{{ old('url') }}">
                    </div>
                    <div class="form-group">
                        <label for="target">@lang('Target*')</label>
                        <select name="target" class="form-control" id="target">
                            <option value="">--ជ្រើសរើស--</option>
                            <option value="_self">ទំព័រដដែល</option>
                            <option value="_blank">ទំព័រថ្មី</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="icon_class">@lang('Icon Class')</label>
                        <input name="icon_class" type="text" class="form-control" id="icon_class"
                               value="{{ old('icon_class') }}">
                    </div>
                    <div class="form-group">
                        <label for="color">@lang('Color')</label>
                        <input name="color" type="color" class="form-control" id="color"
                               value="{{ old('color') }}">
                    </div>
                    <div class="form-group">
                        <label for="order">@lang('Order')</label>
                        <input name="order" type="number" class="form-control" id="order"
                               value="{{ old('order') }}">
                    </div>
                    <div class="form-group">
                        <label for="route">@lang('Route')</label>
                        <input name="route" type="text" class="form-control" id="route"
                               value="{{ old('route') }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">@lang('Create New')</button>
                </div>
            </div>
        </form>
    </div>
@stop
