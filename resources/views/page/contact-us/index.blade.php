@extends('layouts.app')

@section('page-title', __('Pages'))
@section('page-heading', __('Manage Pages'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Contact us')
    </li>
@stop

@section('content')
    @include('partials.messages')

    <table class="table table-hover post-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">@lang('Name')</th>
            <th scope="col">@lang('Email')</th>
            <th scope="col">@lang('Message')</th>
            <th scope="col">@lang('Create')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $item)
            <tr>
                <td class="w-25">{{ $item->name }}</td>
                <td class="w-25">{{ $item->email }}</td>
                <td class="w-25">{{ $item->message }}</td>
                <td class="w-25">{{ dmYDate($item->created_at) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-cb-pagination :pagination="$list"></x-cb-pagination>
@stop

@section('scripts')

@endsection
