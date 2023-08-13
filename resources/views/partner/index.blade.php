@extends('layouts.app')

@section('page-title', __('Partner'))
@section('page-heading', __('Manage Partner'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Partner')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <div class="row">
        <div class="col-6">
            <form class="form-inline" method="GET" action="{{route("partner.index")}}">
                <input class="form-control mr-sm-2 w-75" type="search" placeholder="@lang('Search')" aria-label="Search"
                       name="search" value="{{request()->search}}">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">@lang('Search')</button>
            </form>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a role="button" class="btn btn-primary" href="{{ route('partner.create') }}"><i
                    class="fas fa-plus mr-1"></i>@lang('Create new')</a>
        </div>
    </div>
    <table class="table table-hover category-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('Name')</th>
            <th scope="col">@lang('Image')</th>
            <th scope="col">@lang('Order')</th>
            <th scope="col">@lang('Activity')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{ $item->name }}</td>
                <td>
                    <img src="{{ getFileCDN($item->image)  }}" width="100">
                </td>
                <td>{{ $item->order??"" }}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route("partner.edit",["id"=>$item->id]) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('partner.delete', ["id"=>$item->id]) }}"
                       class="btn btn-sm btn-danger ml-1 {{ $item->count_post > 0 ? 'disabled' : '' }}"
                       title="@lang('លុប Slide')"
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

    <x-cb-pagination :pagination="$data"></x-cb-pagination>
@stop
