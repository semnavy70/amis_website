@extends('layouts.app')

@section('page-title', __('Post log'))
@section('page-heading', __('Manage post'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('post.index') }}" class="text-muted">
            @lang('Post')
        </a>
    </li>
    <li class="breadcrumb-item active">
        @lang('Post log')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <table class="table table-hover status-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('By')</th>
            <th scope="col">@lang('Date')</th>
        </tr>
        </thead>
        <tbody>
        @forelse($list as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->updated_by }}</td>
                <td>{{ dmYHisADate($item->created_at) }}</td>
            </tr>
        @empty
            <tr class="text-center">
                <td colspan="3">@lang('No update post history')</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <x-cb-pagination :pagination="$list"></x-cb-pagination>
@stop
