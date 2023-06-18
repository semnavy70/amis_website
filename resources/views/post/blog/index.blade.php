@extends('layouts.app')

@section('page-title', __('Post blog'))
@section('page-heading', __('Manage post'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Post blog')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <div class="row">
        <div class="col-6">
            <form class="form-inline" action="{{ route('post-blog.index') }}" method="GET">
                <input name="search" class="form-control mr-sm-2 w-75" type="search" placeholder="@lang('Search')"
                       aria-label="Search" value="{{ request()->search }}">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">@lang('Search')</button>
            </form>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a role="button" class="btn btn-primary" href="{{ route('post-blog.create') }}"><i
                    class="fas fa-plus mr-1"></i>@lang('Create new')</a>
        </div>
    </div>
    <table class="table table-hover blog-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('Name')</th>
            <th scope="col">@lang('Slug')</th>
            <th scope="col">@lang('Order')</th>
            <th scope="col">@lang('Total Posts')</th>
            <th scope="col">@lang('Activity')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->slug}}</td>
                <td>{{ $item->order }}</td>
                <td>{{$item->count_post}}</td>
                <td>
                    <a href="{{ route('post-blog.edit', ['id' => $item->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('post-blog.delete', ["id"=>$item->id]) }}"
                       class="btn btn-sm btn-danger ml-1 {{ $item->count_post > 0 ? 'disabled' : '' }}"
                       title="@lang('លុបប្លុក')"
                       data-toggle="tooltip"
                       data-placement="top"
                       data-method="DELETE"
                       data-confirm-title="@lang('ផ្ទៀងផ្ទាត់')"
                       data-confirm-text="@lang('តើអ្នកពិតជាចង់លុបមែនទេ?')"
                       data-confirm-delete="@lang('យល់ព្រម')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <x-cb-pagination :pagination="$list"></x-cb-pagination>
@stop
