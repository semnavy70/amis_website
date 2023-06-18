@extends('layouts.app')

@section('page-title', __('Update'))
@section('page-heading', __('Manage Menus'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('menuitem.index') }}" class="text-muted">
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
        <form action="{{ route('menuitem.update') }}" method="POST" id="post-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $menuItem->id }}">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="menu_id">@lang('Menus')</label>
                        <select name="menu_id" class="form-control" id="menu_id">
                            @foreach($menu as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $menuItem->menu_id ? 'selected' : '' }}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">@lang('Title*')</label>
                        <input name="title" type="text" class="form-control" id="title"
                               value="{{ old('title') ?? $menuItem->title }}">
                    </div>
                    <div class="form-group">
                        <label for="url">@lang('Url*')</label>
                        <input name="url" type="text" class="form-control" id="url"
                               value="{{ old('url') ?? $menuItem->url }}">
                    </div>
                    <div class="form-group">
                        <label for="target">@lang('Target*')</label>
                        <select name="target" class="form-control" id="target">
                            <option value="">--មិនទាន់ជ្រើសរើស--</option>
                            @foreach ([
                                        [
                                            'key'=> '_self',
                                            'name' => 'ទំព័រដដែល'
                                    ], [
                                            'key'=> '_blank',
                                            'name' => 'ទំព័រថ្មី'
                                    ],

                             ] as $item)
                                <option
                                    value="{{ $item['key'] }}" {{ $item['key'] == $menuItem->target ? 'selected' : '' }}>{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="icon_class">@lang('icon_class')</label>
                        <input name="icon_class" type="text" class="form-control" id="icon_class"
                               value="{{ old('icon_class') ?? $menuItem->icon_class }}">
                    </div>
                    <div class="form-group">
                        <label for="color">@lang('color*')</label>
                        <input name="color" type="color" class="form-control" id="color"
                               value="{{ old('color') ?? $menuItem->color }}">
                    </div>
                    <div class="form-group">
                        <label for="order">@lang('order*')</label>
                        <input name="order" type="number" class="form-control" id="order"
                               value="{{ old('order') ?? $menuItem->order }}">
                    </div>
                    <div class="form-group">
                        <label for="route">@lang('route*')</label>
                        <input name="route" type="text" class="form-control" id="route"
                               value="{{ old('route') ?? $menuItem-> route}}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">@lang('Create New')</button>
                </div>
            </div>
        </form>
    </div>
@stop
